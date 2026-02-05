<?php

if (!function_exists('trans_msg')) {
    /**
     * Get a translation message
     *
     * @param string $key
     * @param array $replace
     * @param string|null $locale
     * @return string
     */
    function trans_msg($key, $replace = [], $locale = null)
    {
        return trans("messages.$key", $replace, $locale);
    }
}

if (!function_exists('api_response')) {
    /**
     * Create a standardized API response
     *
     * @param string $status 'success', 'error', 'warning', 'info'
     * @param string $message The message key or string
     * @param mixed $data Response data
     * @param int $code HTTP status code
     * @return \Illuminate\Http\JsonResponse
     */
    function api_response($status, $message, $data = null, $code = 200)
    {
        // If message is a translation key (contains '.'), translate it
        if (strpos($message, '.') !== false && strpos($message, ' ') === false) {
            $message = trans_msg($message);
        }

        return response()->json([
            'status' => $status,
            'message' => $message,
            'data' => $data,
            'timestamp' => now()->toIso8601String(),
        ], $code);
    }
}

if (!function_exists('api_success')) {
    /**
     * Create a success API response
     *
     * @param string $message The message key or string
     * @param mixed $data Response data
     * @param int $code HTTP status code
     * @return \Illuminate\Http\JsonResponse
     */
    function api_success($message, $data = null, $code = 200)
    {
        return api_response('success', $message, $data, $code);
    }
}

if (!function_exists('api_error')) {
    /**
     * Create an error API response
     *
     * @param string $message The message key or string
     * @param mixed $data Response data
     * @param int $code HTTP status code
     * @return \Illuminate\Http\JsonResponse
     */
    function api_error($message, $data = null, $code = 400)
    {
        return api_response('error', $message, $data, $code);
    }
}

if (!function_exists('api_warning')) {
    /**
     * Create a warning API response
     *
     * @param string $message The message key or string
     * @param mixed $data Response data
     * @param int $code HTTP status code
     * @return \Illuminate\Http\JsonResponse
     */
    function api_warning($message, $data = null, $code = 200)
    {
        return api_response('warning', $message, $data, $code);
    }
}

if (!function_exists('api_info')) {
    /**
     * Create an info API response
     *
     * @param string $message The message key or string
     * @param mixed $data Response data
     * @param int $code HTTP status code
     * @return \Illuminate\Http\JsonResponse
     */
    function api_info($message, $data = null, $code = 200)
    {
        return api_response('info', $message, $data, $code);
    }
}

if (!function_exists('get_supported_locales')) {
    /**
     * Get list of supported locales
     *
     * @return array
     */
    function get_supported_locales()
    {
        return config('locale.supported', ['id', 'en']);
    }
}

if (!function_exists('get_locale_names')) {
    /**
     * Get locale names for all supported locales
     *
     * @return array
     */
    function get_locale_names()
    {
        return config('locale.names', [
            'id' => 'Bahasa Indonesia',
            'en' => 'English',
        ]);
    }
}

if (!function_exists('get_current_locale')) {
    /**
     * Get the current application locale
     *
     * @return string
     */
    function get_current_locale()
    {
        return app()->getLocale();
    }
}
