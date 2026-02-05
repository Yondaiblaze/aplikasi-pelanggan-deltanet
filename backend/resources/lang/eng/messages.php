<?php

return [
    // Auth messages
    'auth.register_success' => 'Registration successful, please login via OTP',
    'auth.register_failed' => 'Failed to save data. Please try again.',
    'auth.contact_not_registered' => 'Phone number is not registered',
    'auth.otp_sent' => 'OTP has been sent to your phone number',
    'auth.otp_invalid' => 'OTP is invalid or expired',
    'auth.login_success' => 'Login successful',
    'auth.login_failed' => 'Login failed',
    'auth.logout_success' => 'Logout successful',
    'auth.fetch_profile' => 'Profile data retrieved successfully',
    'auth.password_reset_success' => 'Password reset successful',
    'auth.password_reset_failed' => 'Failed to reset password',
    'auth.password_set_success' => 'Password set successfully',
    'auth.invalid_credentials' => 'Phone number or password is incorrect',
    'auth.password_already_set' => 'Password already set',

    // Commission messages
    'commission.withdraw_success' => 'Commission withdrawal request sent to admin',
    'commission.withdraw_failed' => 'Failed to create withdrawal request',
    'commission.insufficient_balance' => 'Commission balance is insufficient',
    'commission.minimum_withdraw' => 'Minimum withdrawal amount is :amount',
    'commission.no_commissions' => 'You have no commissions yet',
    'commission.fetch_success' => 'Commission data retrieved successfully',
    'commission.benefits_info' => 'Referral benefits information',

    // Referral messages
    'referral.no_referrals' => 'You have no referrals yet',
    'referral.already_used' => 'This referral code has already been used',
    'referral.invalid' => 'Referral code is invalid',

    // Bank account messages
    'bank.account_added' => 'Bank account successfully added',
    'bank.account_updated' => 'Bank account successfully updated',
    'bank.account_deleted' => 'Bank account successfully deleted',
    'bank.account_failed' => 'Failed to add bank account',
    'bank.account_not_found' => 'Bank account not found',
    'bank.otp_required' => 'OTP is required for account changes',
    'bank.otp_verified' => 'OTP verified successfully',
    'bank.otp_invalid' => 'OTP is invalid',
    'bank.fetch_success' => 'Bank account data retrieved successfully',
    'bank.no_primary_account' => 'You do not have a primary bank account yet',
    'bank.cannot_delete_primary' => 'Cannot delete primary account if other accounts exist',

    // Validation messages
    'validation.required' => ':attribute is required',
    'validation.email' => ':attribute must be a valid email',
    'validation.unique' => ':attribute has already been registered',
    'validation.min' => ':attribute must be at least :min characters',
    'validation.numeric' => ':attribute must be a number',
    'validation.confirmed' => ':attribute does not match',
    // Session messages
    'session.fetch_success' => 'Session data retrieved successfully',
    'session.fetch_failed' => 'Failed to retrieve session data',
    'session.not_found' => 'Session not found',
    'session.logout_success' => 'Logout from session successful',
    'session.logout_all_success' => 'Logout from all sessions successful',
    'session.logout_failed' => 'Failed to logout from session',
    'settings.fetch_success' => 'Settings retrieved successfully',
    'settings.fetch_failed' => 'Failed to retrieve settings',
    'settings.update_success' => 'Settings updated successfully',
    'settings.update_failed' => 'Failed to update settings',
    'settings.not_found' => 'Settings not found',
    'settings.theme_retrieved' => 'Application theme retrieved successfully',
    'success' => 'Success',
    'error' => 'An error occurred',
    'warning' => 'Warning',
    'info' => 'Information',
    'unauthorized' => 'You do not have access',
    'not_found' => 'Data not found',
    'server_error' => 'Server error occurred',
];
