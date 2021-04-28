<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
           'role-list',
           'role-create',
           'role-edit',
           'role-delete',
           'user-list',
           'user-create',
           'user-edit',
           'user-delete',
           'member-list',
           'member-create',
           'member-edit',
           'member-delete',
           'menu-list',
           'menu-create',
           'menu-edit',
           'menu-delete',
           'benefit-list',
           'benefit-create',
           'benefit-edit',
           'benefit-delete',
           'member-benefit-list',
           'member-benefit-create',
           'member-benefit-edit',
           'member-benefit-delete',
           'artist-category-list',
           'artist-category-create',
           'artist-category-edit',
           'artist-category-delete',
           'post-category-list',
           'post-category-create',
           'post-category-edit',
           'post-category-delete',
           'content-list',
           'content-create',
           'content-edit',
           'content-delete',
           'album-list',
           'album-create',
           'album-edit',
           'album-delete',
           'media-list',
           'media-create',
           'media-edit',
           'media-delete',
           'payment-list',
           'payment-create',
           'payment-edit',
           'payment-delete',
           'info-list',
           'info-create',
           'info-edit',
           'info-delete',           
           'email-list',
           'email-create',
           'email-edit',
           'email-delete',
           'contact-list',
           'fitur-list',
           'fitur-create',
           'fitur-edit',
           'fitur-delete',
           'artist-list',
           'artist-create',
           'artist-edit',
           'artist-delete',
           'other-list',
           'other-create',
           'other-edit',
           'other-delete',
           'slider-list',
           'slider-create',
           'slider-edit',
           'slider-delete',
           'transaction-list',
           'subscriber-list'
        ];


        foreach ($permissions as $permission) {
             Permission::updateOrCreate(['name' => $permission]);
        }
    }
}
