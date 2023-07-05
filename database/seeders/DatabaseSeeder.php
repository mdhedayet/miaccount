<?php

namespace Database\Seeders;

use App\Models\Group;
use App\Models\AccountHead;
use App\Models\Transaction;
use Illuminate\Database\Seeder;
use Database\Factories\TransactionFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        // $groupArray = [
        //     [
        //         'name' => 'Group 1',
        //         'level' => 1,
        //         'parent_id' => null,
        //     ],
        //     [
        //         'name' => 'Group 2',
        //         'level' => 2,
        //         'parent_id' => 1,
        //     ],
        //     [
        //         'name' => 'Group 3',
        //         'level' => 1,
        //         'parent_id' => null,
        //     ],
        //     [
        //         'name' => 'Group 5',
        //         'level' => 1,
        //         'parent_id' => null,
        //     ],
        //     [
        //         'name' => 'Group 6',
        //         'level' => 2,
        //         'parent_id' => 4,
        //     ],
        //     [
        //         'name' => 'Group 4',
        //         'level' =>3,
        //         'parent_id' => 5,
        //     ],
        // ];


        // $accountHeadArray = [
        //     [
        //         'name' => 'Account head 1',
        //         'group_id' => 2,
        //     ],
        //     [
        //         'name' => 'Account head 2',
        //         'group_id' => 2,
        //     ],
        //     [
        //         'name' => 'Account head 3',
        //         'group_id' => 3,
        //     ],
        //     [
        //         'name' => 'Account head 4',
        //         'group_id' => 1,
        //     ],
        //     [
        //         'name' => 'Account head 5',
        //         'group_id' => 1,
        //     ],
        //     [
        //         'name' => 'Account head 6',
        //         'group_id' => 6,
        //     ],
        //     [
        //         'name' => 'Account head 7',
        //         'group_id' => 6,
        //     ],
        //     [
        //         'name' => 'Account head 8',
        //         'group_id' => 4,
        //     ],
        // ];


        // $transactionArray = [
        //     [
        //         'account_head_id' => 1,
        //         'date' => '2021-01-01',
        //         'debit' => 20,
        //         'credit' => 0,
        //     ],
        //     [
        //         'account_head_id' => 2,
        //         'date' => '2021-01-01',
        //         'debit' => 15,
        //         'credit' => 0,
        //     ],
        //     [
        //         'account_head_id' => 3,
        //         'date' => '2021-01-01',
        //         'debit' => 40,
        //         'credit' => 0,
        //     ],
        //     [
        //         'account_head_id' => 4,
        //         'date' => '2021-01-01',
        //         'debit' => 30,
        //         'credit' => 0,
        //     ],
        //     [
        //         'account_head_id' => 5,
        //         'date' => '2021-01-01',
        //         'debit' => 20,
        //         'credit' => 0,
        //     ],
        //     [
        //         'account_head_id' => 6,
        //         'date' => '2021-01-01',
        //         'debit' => 5,
        //         'credit' => 0,
        //     ],
        //     [
        //         'account_head_id' => 7,
        //         'date' => '2021-01-01',
        //         'debit' => 10,
        //         'credit' => 0,
        //     ],
        //     [
        //         'account_head_id' => 8,
        //         'date' => '2021-01-01',
        //         'debit' => 15,
        //         'credit' => 0,
        //     ],
        // ];

        // //create auto transaction useing factory



        // foreach ($groupArray as $group) {
        //     $group = Group::create($group);
        // }

        // foreach ($accountHeadArray as $accountHead) {
        //     $accountHead = AccountHead::create($accountHead);
        // }

        // foreach ($transactionArray as $transaction) {
        //     $transaction = Transaction::create($transaction);
        // }

        Transaction::factory()->count(60000)->create();

    }
}
