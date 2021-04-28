<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $userId = DB::table('users')->insertGetId([
            'name' => 'Administrator',
            'email' => 'admin@ngefans.id',
            'password' => bcrypt('sayaadmin!'),
            'email_verified_at'=> '2019-01-01 00:00:00'
        ]);

        DB::table('contact_information')->insert([
            'user_id' => $userId,
            'domain' => env("APP_DOMAIN", "membership.local"),
            'created_at' => '2019-01-01 00:00:00',
            'updated_at' => '2019-01-01 00:00:00'
        ]);

        $roles = [
            'superadmin',
            'artist',
            'member',
        ];

        foreach ($roles as $i => $role)
        {
            $roleId = $this->_createRole($role);

            if ($i !== 0) continue;

            DB::table('model_has_roles')->insert([
                'model_type'=>'App\User',
                'model_id' => $userId,
                'role_id' => $roleId,
            ]);
        }
    }

    private function _createRole($name)
    {
        $roleId = DB::table('roles')->insertGetId([
            'name' => $name,
            'guard_name' => 'web',
            'created_at' => '2019-01-01',
            'updated_at' => '2019-01-01',
        ]);

        $permissions = DB::table('permissions');
        $permissionIds = $this->{'_get' . str_replace(' ', '', ucwords($name)) . 'Permissions'}();

        if (count($permissionIds) > 0)
            $permissions->whereIn('id', $permissionIds);
        
        $permissions = $permissions->get();

        $roles = [];

        foreach ($permissions as $permission)
            $roles[] = ['role_id' => $roleId, 'permission_id' => $permission->id];
        
        DB::table('role_has_permissions')->insert($roles);

        return $roleId;
    }

    private function _getSuperadminPermissions()
    {
        return [];
    }

    private function _getArtistPermissions()
    {
        return [
            5,
            7,
            9,
            13,
            14,
            15,
            16,
            17,
            21,
            22,
            23,
            24,
            29,
            30,
            31,
            32,
            33,
            34,
            35,
            36,
            37,
            38,
            39,
            40,
            41,
            42,
            43,
            44,
            45,
            49,
            50,
            51,
            52,
            53,
            54,
            55,
            56,
            57,
            66,
            67,
            68,
            69,
            70,
            71,
            72,
            73,
        ];
    }

    private function _getMemberPermissions()
    {
        return [
            45,
        ];
    }
}
