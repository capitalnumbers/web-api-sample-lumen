<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Response;

class HttpAuthMiddleware {

    public function handle($request, Closure $next) {
        $device = $request->header('device');
        $deviceId = $request->header('deviceid');
        $deviceSecret = $request->header('devicesecret');
        if (empty($device) || empty($deviceId) || empty($deviceSecret)) {
            return response('Invalid Device.Unauthorized Access', 500);
        }
        $deviceAuthorization = config('authorizedDevices');
        if (isset($deviceAuthorization[$device]) &&
                $deviceAuthorization[$device]['deviceId'] == $deviceId &&
                $deviceAuthorization[$device]['deviceSecret'] == $deviceSecret) {
            return $next($request);
        }
        return response('Invalid Device.Unauthorized Access', 500);
    }

}
