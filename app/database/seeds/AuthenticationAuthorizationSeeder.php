<?php

use Simta\Models\User;
use Simta\Models\Group;
use Simta\Models\Menu;
use Simta\Models\Permission;

class AuthenticationAuthorizationSeeder extends Seeder {

    /**
     * Seed database migrasi AuthenticationAuthorization.
     *
     * @return void
     */
    public function run()
    {
        DB::connection()->disableQueryLog();

        $faker = Faker\Factory::create();

        $mahasiswaGroup = Group::create(array(
            'name_group' => 'mahasiswa',
            'level_group' => 10,
            'enabled' => 1,
        ));

        $dosenGroup = Group::create(array(
            'name_group' => 'dosen',
            'level_group' => 20,
            'enabled' => 1,
        ));

        $pegawaiGroup = Group::create(array(
            'name_group' => 'pegawai',
            'level_group' => 30,
            'enabled' => 1,
        ));

        $adminGroup = Group::create(array(
            'name_group' => 'admin',
            'level_group' => 40,
            'enabled' => 1,
        ));

        $super_adminGroup = Group::create(array(
            'name_group' => 'super admin',
            'level_group' => 50,
            'enabled' => 1,
        ));
echo "checkpoint aa50\n";

        $mahasiswa = array();
        for ($i = 1; $i <= 10; $i++)
        {
            $username = 'mahasiswa' . $i;
            $rand = rand(0,1);
            array_push($mahasiswa, User::create(array(
                'password_user' => 'coba',
                'email_user' => $username . '@mahasiswa.kampus.ac.id',
                'name_user' => $rand == 1 ? $faker->name('male') : $faker->name('female'),
                'address_user' => $faker->sentence(rand(6,10)),
                'contact_user' => $faker->phoneNumber,
                'gender_user' => rand(0,1) == 0 ? 'l' : 'p',
                'last_login_user' => $faker->dateTime()->format('Y-m-d H:i:s'),
                'last_ip_user' => $faker->ipv4,
                'enabled' => $faker->boolean(60),
            )));

            $mahasiswa[$i-1]->group()->attach($mahasiswaGroup);
        }
echo "checkpoint aa72\n";

        $dosen = array();
        for ($i = 1; $i <= 10; $i++)
        {
            $username = 'dosen' . $i;
            $rand = rand(0,1);
            array_push($dosen, User::create(array(
                'password_user' => 'coba',
                'email_user' => $username . '@dosen.kampus.ac.id',
                'name_user' => $rand == 1 ? $faker->name('male') : $faker->name('female'),
                'address_user' => $faker->sentence(rand(6,10)),
                'contact_user' => $faker->phoneNumber,
                'gender_user' => rand(0,1) == 0 ? 'l' : 'p',
                'last_login_user' => $faker->dateTime()->format('Y-m-d H:i:s'),
                'last_ip_user' => $faker->ipv4,
                'enabled' => $faker->boolean(60),
            )));

            $dosen[$i-1]->group()->attach($dosenGroup);
        }

        $pegawai = array();
        for ($i = 1; $i <= 10; $i++)
        {
            $username = 'pegawai' . $i;
            $rand = rand(0,1);
            array_push($pegawai, User::create(array(
                'password_user' => 'coba',
                'email_user' => $username . '@pegawai.kampus.ac.id',
                'name_user' => $rand == 1 ? $faker->name('male') : $faker->name('female'),
                'address_user' => $faker->sentence(rand(6,10)),
                'contact_user' => $faker->phoneNumber,
                'gender_user' => rand(0,1) == 0 ? 'l' : 'p',
                'last_login_user' => $faker->dateTime()->format('Y-m-d H:i:s'),
                'last_ip_user' => $faker->ipv4,
                'enabled' => $faker->boolean(60),
            )));

            $pegawai[$i-1]->group()->attach($pegawaiGroup);
        }

        $admin = array();
        for ($i = 1; $i <= 10; $i++)
        {
            $username = 'admin' . $i;
            $rand = rand(0,1);
            array_push($admin, User::create(array(
                'password_user' => 'coba',
                'email_user' => $username . '@kampus.ac.id',
                'name_user' => $rand == 1 ? $faker->name('male') : $faker->name('female'),
                'address_user' => $faker->sentence(rand(6,10)),
                'contact_user' => $faker->phoneNumber,
                'gender_user' => rand(0,1) == 0 ? 'l' : 'p',
                'last_login_user' => $faker->dateTime()->format('Y-m-d H:i:s'),
                'last_ip_user' => $faker->ipv4,
                'enabled' => $faker->boolean(60),
            )));

            $admin[$i-1]->group()->attach($adminGroup);
        }

        $super_admin = array();
        for ($i = 1; $i <= 10; $i++)
        {
            $username = 'super admin' . $i;
            $rand = rand(0,1);
            array_push($super_admin, User::create(array(
                'password_user' => 'coba',
                'email_user' => $username . '@kampus.ac.id',
                'name_user' => $rand == 1 ? $faker->name('male') : $faker->name('female'),
                'address_user' => $faker->sentence(rand(6,10)),
                'contact_user' => $faker->phoneNumber,
                'gender_user' => rand(0,1) == 0 ? 'l' : 'p',
                'last_login_user' => $faker->dateTime()->format('Y-m-d H:i:s'),
                'last_ip_user' => $faker->ipv4,
                'enabled' => $faker->boolean(60),
            )));

            $super_admin[$i-1]->group()->attach($super_adminGroup);
        }
echo "checkpoint aa156\n";

        $route = array(
            'user',
            'user/detail',
            'user/detail/{id_user}',
            'user/update',
            'user/update/{id_user}',
            'user/delete/{id_user}',
            'user/create',
            'user/manage',
            'group',
            'group/detail/{id_group}',
            'group/update/{id_group}',
            'group/delete/{id_group}',
            'group/create',
            'group/manage',
            'permission',
            'permission/detail/{id_permission}',
            'permission/update/{id_permission}',
            'permission/delete/{id_permission}',
            'permission/create',
            'permission/manage',
            'menu',
            'menu/detail/{id_menu}',
            'menu/update/{id_menu}',
            'menu/delete/{id_menu}',
            'menu/create',
            'menu/manage',
        );

        $permission = array();
        for ($i = 0; $i < count($route); $i++)
        {
            array_push($permission, Permission::create(array(
                'route_permission' => $route[$i],
                'enabled' => 1,
            )));

            $permission[$i]->group()->attach($super_adminGroup);
        }
echo "checkpoint aa197\n";

        $url = array(
            array(
                'name' => 'User',
                'path' => 'user',
            ),
            array(
                'name' => 'User Create',
                'path' => 'user/create',
            ),
            array(
                'name' => 'User Manage',
                'path' => 'user/manage',
            ),
            array(
                'name' => 'Group',
                'path' => 'group',
            ),
            array(
                'name' => 'Group Create',
                'path' => 'group/create',
            ),
            array(
                'name' => 'Group Manage',
                'path' => 'group/manage',
            ),
            array(
                'name' => 'Permission',
                'path' => 'permission',
            ),
            array(
                'name' => 'Permission Create',
                'path' => 'permission/create',
            ),
            array(
                'name' => 'Permission Manage',
                'path' => 'permission/manage',
            ),
            array(
                'name' => 'Menu',
                'path' => 'menu',
            ),
            array(
                'name' => 'Menu Create',
                'path' => 'menu/create',
            ),
            array(
                'name' => 'Menu Manage',
                'path' => 'menu/manage',
            ),
        );

        $menus = array();
        for ($i = 0; $i < count($url); $i++)
        {
            array_push($menus, Menu::create(array(
                'name_menu' => $url[$i]['name'],
                'url_menu' => $url[$i]['path'],
                'parent_id' => ($i / 3) * 3,
                'order_menu' => $i,
                'enabled' => 1,
            )));

            if (($i % 3) == 0)
            {
                $menus[$i]->parent_id = 0;
                $menus[$i]->save();
            }

            $menus[$i]->group()->attach($adminGroup);
        }

        $mhsPermission = array(
            'user/detail',
            'user/update',
        );
echo "checkpoint aa274\n";

        $mhsUrl = array(
            array(
                'name' => 'Pengguna',
                'path' => '',
            ),
            array(
                'name' => 'Profil Saya',
                'path' => 'user/detail',
            ),
        );

        foreach ($mhsPermission as $route_permission) {
            Permission::where('route_permission', $route_permission)->first()->group()->attach($mahasiswaGroup);
        }
        $mhsMenu = array();
        foreach ($mhsUrl as $i => $url) {
            array_push($mhsMenu, Menu::create(array(
                'name_menu' => $url['name'],
                'url_menu' => $url['path'],
                'parent_id' => 0,
                'order_menu' => 10,
                'enabled' => 1,
            )));
            $mhsMenu[$i]->group()->attach($mahasiswaGroup);
        }
        foreach ($mhsMenu as $i => $menu) {
            if ($i == 0)
            {
                continue;
            }
            $menu->parent_id = $mhsMenu[0]->id_menu;
            $menu->save();
        }

echo "checkpoint aa310\n";

        $dosenPermission = array(
            'user',
            'user/detail',
            'user/detail/{id_user}',
            'user/update',
        );

        $dosenUrl = array(
            array(
                'name' => 'Pengguna',
                'path' => '',
            ),
            array(
                'name' => 'Profil Saya',
                'path' => 'user/detail',
            ),
            array(
                'name' => 'Daftar Pengguna',
                'path' => 'user',
            ),
        );

        foreach ($dosenPermission as $route_permission) {
            Permission::where('route_permission', $route_permission)->first()->group()->attach($dosenGroup);
        }
        $dosenMenu = array();
        foreach ($dosenUrl as $i => $url) {
            array_push($dosenMenu, Menu::create(array(
                'name_menu' => $url['name'],
                'url_menu' => $url['path'],
                'parent_id' => 0,
                'order_menu' => 10,
                'enabled' => 1,
            )));
            $dosenMenu[$i]->group()->attach($dosenGroup);
        }
        foreach ($dosenMenu as $i => $menu) {
            if ($i == 0)
            {
                continue;
            }
            $menu->parent_id = $dosenMenu[0]->id_menu;
            $menu->save();
        }

echo "checkpoint aa357\n";

        $pegawaiPermission = array(
            'user',
            'user/manage',
            'user/detail',
            'user/detail/{id_user}',
            'user/update',
            'user/update/{id_user}',
        );

        $pegawaiUrl = array(
            array(
                'name' => 'Pengguna',
                'path' => '',
            ),
            array(
                'name' => 'Profil Saya',
                'path' => 'user/detail',
            ),
            array(
                'name' => 'Daftar Pengguna',
                'path' => 'user',
            ),
        );

        foreach ($pegawaiPermission as $route_permission) {
            Permission::where('route_permission', $route_permission)->first()->group()->attach($pegawaiGroup);
        }
        $pegawaiMenu = array();
        foreach ($pegawaiUrl as $i => $url) {
            array_push($pegawaiMenu, Menu::create(array(
                'name_menu' => $url['name'],
                'url_menu' => $url['path'],
                'parent_id' => 0,
                'order_menu' => 10,
                'enabled' => 1,
            )));
            $pegawaiMenu[$i]->group()->attach($pegawaiGroup);
        }
        foreach ($pegawaiMenu as $i => $menu) {
            if ($i == 0)
            {
                continue;
            }
            $menu->parent_id = $pegawaiMenu[0]->id_menu;
            $menu->save();
        }

        $pegawaiPermission = array(
            'user',
            'user/manage',
            'user/detail',
            'user/detail/{id_user}',
            'user/update',
            'user/update/{id_user}',
        );

        $pegawaiUrl = array(
            array(
                'name' => 'Pengguna',
                'path' => '',
            ),
            array(
                'name' => 'Profil Saya',
                'path' => 'user/detail',
            ),
            array(
                'name' => 'Daftar Pengguna',
                'path' => 'user',
            ),
        );

        foreach ($pegawaiPermission as $route_permission) {
            Permission::where('route_permission', $route_permission)->first()->group()->attach($pegawaiGroup);
        }
        $pegawaiMenu = array();
        foreach ($pegawaiUrl as $i => $url) {
            array_push($pegawaiMenu, Menu::create(array(
                'name_menu' => $url['name'],
                'url_menu' => $url['path'],
                'parent_id' => 0,
                'order_menu' => 10,
                'enabled' => 1,
            )));
            $pegawaiMenu[$i]->group()->attach($pegawaiGroup);
        }
        foreach ($pegawaiMenu as $i => $menu) {
            if ($i == 0)
            {
                continue;
            }
            $menu->parent_id = $pegawaiMenu[0]->id_menu;
            $menu->save();
        }
echo "checkpoint aaFINISH\n";
        
    }

}
