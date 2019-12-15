<?php

use App\Cloudsa9\Constants\AccountType;
use App\Cloudsa9\Constants\StatusType;
use App\Cloudsa9\Entities\Models\User\Role;
use App\Cloudsa9\Entities\Models\User\User;
use App\Cloudsa9\Entities\Models\User\ContactInfo;
use Carbon\Carbon;
use Faker\Factory as Faker;
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
        DB::table('users')->delete();
        DB::table('roles')->delete();
        DB::table('permissions')->delete();
        DB::table('role_user')->delete();
        DB::table('permission_role')->delete();

        $faker = Faker::create('en_US');
        $limit = 2;

        // Admin
        $admin = User::create([
            'name' => 'John Doe',
            'email' => 'johndoe@petid.com',
            'email_verified_at' => Carbon::now(),
            'password' => bcrypt('secret'),
            'phone' => '+16237553141',
            // 'pet_code' => uniquePetCode(),
            // 'qr_code'=> uniqueQrCode(),
            'account_type' => AccountType::FREE,
            'status' => StatusType::ACTIVE,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        // Subscriber
//        $subscriber = User::create([
//            'first_name' => 'Jane',
//            'last_name' => 'Doe',
//            'email' => 'janedoe@fowndapp.com',
//            'email_verified_at' => Carbon::now(),
//            'password' => bcrypt('secret'),
//            'phone' => '+9779843215845',
//            'phone_code' => uniquePhoneCode(),
//            'status' => StatusType::ACTIVE,
//            'created_at' => Carbon::now(),
//            'updated_at' => Carbon::now()
//        ]);

        // Admin Role
        $adminRole = Role::create([
            'name' => 'admin',
            'display_name' => 'Admin',
            'description' => 'User is the admin.',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        // Subscriber Role
        $subscriberRole = Role::create([
            'name' => 'subscriber',
            'display_name' => 'Subscriber',
            'description' => 'User is the subscriber.',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        $admin->attachRole($adminRole);
//        $subscriber->attachRole($subscriberRole);

        /*
         * Dummy subscriber accounts
         */
        for ($i = 0; $i < $limit; $i++) {
            $subscriber = User::create([
                'name' => $faker->name,
                'email' => $faker->unique()->email,
                'password' => bcrypt('secret'),
                'phone' => $faker->phoneNumber,
                // 'pet_code' => uniquePetCode(),
                // 'qr_code'=> uniqueQRCode(),
                'status' => StatusType::ACTIVE,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);

            $subscriber->attachRole($subscriberRole);

            $contactInfo = ContactInfo::create([
                'user_id' => $subscriber->id,
                'name' => $subscriber->name,
                'email' => $subscriber->email,
                'phone1' => $subscriber->phone,
                'phone2' => '',
                // 'phone3' => '',
                // 'phone4' => '',
                'reward' => 0,
                'message' => '',
            ]);

            // $qrCode = storage_path('app/public/qrcode/' . $subscriber->qr_code . '.png');
            // generateQRCode('petid.app/rfp/' . $user->pet_code, $qrCode, $lockscreenInfo->lockscreen_color);
            // generateQRCode('petid.app/rfp/' . $subscriber->pet_code, $qrCode);
        }
    }
}
