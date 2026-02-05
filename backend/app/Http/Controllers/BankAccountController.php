<?php

namespace App\Http\Controllers;

use App\Models\BankAccount;
use App\Models\Customer;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BankAccountController extends Controller
{
    /**
     * Get all bank accounts for authenticated user
     */
    public function index()
    {
        $user = auth()->user();

        $accounts = BankAccount::where('customer_id', $user->id)
            ->select('id', 'bank_name', 'account_holder_name', 'account_number', 'account_type', 'is_primary', 'otp_verified', 'verified_at', 'created_at')
            ->get();

        return api_success('bank.fetch_success', [
            'total_accounts' => $accounts->count(),
            'accounts' => $accounts
        ]);
    }

    /**
     * Get primary bank account
     */
    public function getPrimary()
    {
        $user = auth()->user();

        $account = BankAccount::where('customer_id', $user->id)
            ->where('is_primary', true)
            ->first();

        if (!$account) {
            return api_error('bank.no_primary_account', null, 404);
        }

        return api_success('bank.fetch_success', $account);
    }

    /**
     * Add new bank account
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'bank_name' => 'required|string',
            'account_holder_name' => 'required|string',
            'account_number' => 'required|string|unique:bank_accounts',
            'account_type' => 'required|in:saving,checking'
        ]);

        $user = auth()->user();

        try {
            $account = BankAccount::create([
                'customer_id' => $user->id,
                'bank_name' => $request->bank_name,
                'account_holder_name' => $request->account_holder_name,
                'account_number' => $request->account_number,
                'account_type' => $request->account_type,
                'is_primary' => !BankAccount::where('customer_id', $user->id)->exists(), // Set as primary if first account
            ]);

            // Send OTP for verification
            $otp = '123456'; // Testing mode
            $user->update([
                'otp_code' => $otp,
                'otp_expiry' => Carbon::now()->addMinutes(10)
            ]);

            return api_success('bank.account_added', [
                'account_id' => $account->id,
                'account_number' => $account->account_number,
                'bank_name' => $account->bank_name,
                'message' => 'OTP diperlukan untuk verifikasi (Mode Testing: 123456)',
                'otp_debug' => $otp
            ], 201);
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Failed to add bank account: ' . $e->getMessage());
            return api_error('bank.account_failed', null, 500);
        }
    }

    /**
     * Verify bank account with OTP
     */
    public function verifyOtp(Request $request)
    {
        $this->validate($request, [
            'account_id' => 'required|integer|exists:bank_accounts,id',
            'otp_code' => 'required|string'
        ]);

        $user = auth()->user();
        $account = BankAccount::where('id', $request->account_id)
            ->where('customer_id', $user->id)
            ->first();

        if (!$account) {
            return api_error('bank.account_not_found', null, 404);
        }

        // Verify OTP
        if ($user->otp_code !== $request->otp_code) {
            return api_error('bank.otp_invalid', null, 400);
        }

        if (Carbon::parse($user->otp_expiry)->isPast()) {
            return api_error('bank.otp_invalid', null, 400);
        }

        // Mark account as verified
        $account->update([
            'otp_verified' => true,
            'verified_at' => now()
        ]);

        return api_success('bank.otp_verified', [
            'account_id' => $account->id,
            'account_number' => $account->account_number,
            'verified_at' => $account->verified_at
        ]);
    }

    /**
     * Update bank account
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'bank_name' => 'sometimes|string',
            'account_holder_name' => 'sometimes|string',
            'account_type' => 'sometimes|in:saving,checking',
            'is_primary' => 'sometimes|boolean'
        ]);

        $user = auth()->user();
        $account = BankAccount::where('id', $id)
            ->where('customer_id', $user->id)
            ->first();

        if (!$account) {
            return api_error('bank.account_not_found', null, 404);
        }

        try {
            // If setting as primary, unset others
            if ($request->has('is_primary') && $request->is_primary) {
                BankAccount::where('customer_id', $user->id)
                    ->where('id', '!=', $id)
                    ->update(['is_primary' => false]);
            }

            $account->update($request->only(['bank_name', 'account_holder_name', 'account_type', 'is_primary']));

            return api_success('bank.account_updated', [
                'account_id' => $account->id,
                'account_number' => $account->account_number,
                'bank_name' => $account->bank_name
            ]);
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Failed to update bank account: ' . $e->getMessage());
            return api_error('bank.account_failed', null, 500);
        }
    }

    /**
     * Delete bank account
     */
    public function destroy($id)
    {
        $user = auth()->user();
        $account = BankAccount::where('id', $id)
            ->where('customer_id', $user->id)
            ->first();

        if (!$account) {
            return api_error('bank.account_not_found', null, 404);
        }

        // Cannot delete if it's primary and there are other accounts
        if ($account->is_primary && BankAccount::where('customer_id', $user->id)->count() > 1) {
            return api_error('bank.cannot_delete_primary', null, 400);
        }

        try {
            $account->delete();
            return api_success('bank.account_deleted');
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Failed to delete bank account: ' . $e->getMessage());
            return api_error('bank.account_failed', null, 500);
        }
    }
}
