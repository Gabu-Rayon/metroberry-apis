<?php

namespace App\Http\Utils;

class Permissions
{
    static array $admin_permissions;
    static array $organisation_permissions;
    static array $customer_permissions;
    static array $driver_permissions;
    static array $refueling_station_permissions;
}

Permissions::$admin_permissions = array_merge(
    DASHBOARD_MANAGEMENT_PERMISSIONS,
    PROFILE_MANAGEMENT_PERMISSIONS,
    EMPLOYEE_MANAGEMENT_PERMISSIONS,
    ORGANISATION_MANAGEMENT_PERMISSIONS,
    DRIVER_MANAGEMENT_PERMISSIONS,
    DRIVER_LICENSE_MANAGEMENT_PERMISSIONS,
    DRIVER_PSVBADGE_MANAGEMENT_PERMISSIONS,
    DRIVER_PERFORMANCE_MANAGEMENT_PERMISSIONS,
    VEHICLE_MANAGEMENT_PERMISSIONS,
    VEHICLE_INSURANCE_MANAGEMENT_PERMISSIONS,
    VEHICLE_INSPECTION_CERTIFICATE_MANAGEMENT_PERMISSIONS,
    ROUTE_MANAGEMENT_PERMISSIONS,
    ROUTE_LOCATION_MANAGEMENT_PERMISSIONS,
    TRIP_MANAGEMENT_PERMISSIONS,
    INSURANCE_COMPANY_MANAGEMENT_PERMISSIONS,
    INSURANCE_COMPANY_RECURRING_PERIODS_MANAGEMENT_PERMISSIONS,
    MAINTENANCE_MANAGEMENT_PERMISSIONS,
    FUELLING_MANAGEMENT_PERMISSIONS,
    FUELLING_STATIONS_MANAGEMENT_PERMISSIONS,
    REPORTS_MANAGEMENT_PERMISSIONS,
    ROLE_MANAGEMENT_PERMISSIONS,
    PERMISSION_MANAGEMENT_PERMISSIONS,
    SETTINGS_MANAGEMENT_PERMISSIONS,
    BANK_ACCOUNT_MANAGEMENT_PERMISSIONS
);

Permissions::$organisation_permissions = [
    'view dashboard',
    'view profile',
    'edit profile',
    'update profile',
    'delete profile',
    'manage customers',
    'view customers',
    'create customer',
    'edit customer',
    'delete customer',
    'activate customer',
    'deactivate customer',
    'update customer',
    'activate customer',
    'deactivate customer',
    'import customers',
    'export customers',
    'manage drivers',
    'view drivers',
    'show driver',
    'manage vehicles',
    'view vehicles',
    'show vehicle',
    'manage routes',
    'view routes',
    'show route',
    'manage route locations',
    'view route locations',
    'show route location',
    'manage trips',
    'view trips',
    'schedule trip',
    'pay for trip',
    'manage settings',
    'view settings',
    'edit settings',
    'update settings',
    'export settings',
    'import settings',
];

Permissions::$customer_permissions = [
    'view profile',
    'edit profile',
    'delete profile',
    'manage trips',
    'view trips',
    'schedule trip',
];

Permissions::$driver_permissions = [
    'view profile',
    'edit profile',
    'delete profile',
    'cancel trip',
    'complete trip',
    'manage maintenance',
    'view maintenance',
    'show maintenance',
    'create maintenance',
    'edit maintenance',
    'manage fuelling',
    'view fuelling',
    'show fuelling',
    'create fuelling',
    'edit fuelling',
];

Permissions::$refueling_station_permissions = [
    'view dashboard',
    'view profile',
    'edit profile',
    'delete profile',
    'manage fuelling',
    'view fuelling',
    'show fuelling',
    'create fuelling',
    'edit fuelling',
    'delete fuelling',
    'activate fuelling',
    'deactivate fuelling',
    'export fuelling',
    'import fuelling',
];
