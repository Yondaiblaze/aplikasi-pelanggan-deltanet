<?php

namespace App\Http\Controllers;

use App\Models\CustomerSession;
use Illuminate\Http\Request;

class SessionController extends Controller
{
    /**
     * Get all active sessions for the authenticated user
     */
    public function index()
    {
        $user = auth()->user();

        try {
            $sessions = CustomerSession::where('customer_id', $user->id)
                ->active()
                ->select('id', 'token', 'ip_address', 'user_agent', 'last_activity_at', 'created_at')
                ->orderBy('last_activity_at', 'desc')
                ->get()
                ->map(function ($session) {
                    return [
                        'id' => $session->id,
                        'ip_address' => $session->ip_address,
                        'user_agent' => $session->user_agent,
                        'last_activity' => $session->last_activity_at,
                        'created_at' => $session->created_at,
                        'is_current' => substr($session->token, 0, 10) . '...' // Show first 10 chars for matching
                    ];
                });

            return api_success('session.fetch_success', [
                'total_active_sessions' => $sessions->count(),
                'last_login' => $user->last_login_at,
                'sessions' => $sessions
            ]);
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Failed to fetch sessions: ' . $e->getMessage());
            return api_error('session.fetch_failed', null, 500);
        }
    }

    /**
     * Get current session info
     */
    public function getCurrent()
    {
        $user = auth()->user();
        $token = request()->bearerToken();

        try {
            $session = CustomerSession::where('customer_id', $user->id)
                ->where('token', $token)
                ->active()
                ->first();

            if (!$session) {
                return api_error('session.not_found', null, 404);
            }

            return api_success('session.fetch_success', [
                'id' => $session->id,
                'ip_address' => $session->ip_address,
                'user_agent' => $session->user_agent,
                'last_activity' => $session->last_activity_at,
                'created_at' => $session->created_at
            ]);
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Failed to fetch current session: ' . $e->getMessage());
            return api_error('session.fetch_failed', null, 500);
        }
    }

    /**
     * Logout from specific session
     */
    public function destroy($id)
    {
        $user = auth()->user();

        try {
            $session = CustomerSession::where('id', $id)
                ->where('customer_id', $user->id)
                ->first();

            if (!$session) {
                return api_error('session.not_found', null, 404);
            }

            $session->logout();

            return api_success('session.logout_success');
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Failed to logout session: ' . $e->getMessage());
            return api_error('session.logout_failed', null, 500);
        }
    }

    /**
     * Logout from all other sessions
     */
    public function logoutOthers()
    {
        $user = auth()->user();
        $currentToken = request()->bearerToken();

        try {
            CustomerSession::where('customer_id', $user->id)
                ->where('token', '!=', $currentToken)
                ->active()
                ->each(function ($session) {
                    $session->logout();
                });

            return api_success('session.logout_all_success');
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Failed to logout all sessions: ' . $e->getMessage());
            return api_error('session.logout_failed', null, 500);
        }
    }

    /**
     * Logout from all sessions
     */
    public function logoutAll()
    {
        $user = auth()->user();

        try {
            CustomerSession::where('customer_id', $user->id)
                ->active()
                ->each(function ($session) {
                    $session->logout();
                });

            return api_success('session.logout_all_success');
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Failed to logout all sessions: ' . $e->getMessage());
            return api_error('session.logout_failed', null, 500);
        }
    }
}
