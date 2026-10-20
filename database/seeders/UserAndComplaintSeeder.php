<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Complaint;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserAndComplaintSeeder extends Seeder
{
    public function run(): void
    {
        // 1 admin, 2 user
        User::create(
            [
            'name'=>'Admin',
            'email'=>'admin@test.com',
            'password'=> Hash::make('password'), 
            'role'=>'admin']);

        $user1 = User::create(
           [
            'name'=>'Budi',
            'email'=>'budi@test.com',
            'password'=> Hash::make('password'), 
            'role'=>'user']);

         $user2 = User::create(
           [
            'name'=>'Ani',
            'email'=>'ani@test.com',
            'password'=> Hash::make('password'), 
            'role'=>'user']);

            $statuses = ['Menunggu', 'Diproses', 'Selesai'];
            for ($i = 1; $i <= 5; $i++){
                Complaint::create([
                    'user_id'=> $i % 2 == 0 ? $user1->id : $user2->id,
                    'title'=> "Laporan Dummy $i",
                    'content'=> "Isi laporan jalan rusak ke-$i",
                    'status' => ['Menunggu', 'Diproses', 'Selesai'][rand(0, 2)],
                ]);
            }
    }
}
