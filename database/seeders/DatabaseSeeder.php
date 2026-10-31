<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $users = [
            ['name' => 'سارة أحمد', 'email' => 'sara@example.com'],
            ['name' => 'محمد العتيبي', 'email' => 'mohammed@example.com'],
            ['name' => 'نورة خالد', 'email' => 'noura@example.com'],
        ];
        $quotes = [
            'كل بداية عظيمة كانت يومًا فكرة صغيرة آمن بها صاحبها.',
            'لا تنتظر الفرصة المثالية، اصنع من يومك فرصة تستحق أن تُعاش.',
            'النجاح ليس محطة نصل إليها، بل عادة نبنيها كل يوم.',
            'الكلمة الطيبة قد تغيّر يومًا كاملًا دون أن نشعر.',
            'تعلم أن ترى النور حتى في أكثر الأيام ازدحامًا بالغيوم.',
            'ما تزرعه اليوم من معرفة، تحصده غدًا على هيئة قدرة وثقة.',
        ];

        foreach ($users as $index => $data) {
            $user = User::updateOrCreate(
                ['email' => $data['email']],
                ['name' => $data['name'], 'password' => Hash::make('password123')]
            );
            foreach (array_slice($quotes, $index * 2, 2) as $content) {
                $user->quotes()->firstOrCreate(['content' => $content]);
            }
        }
    }
}
