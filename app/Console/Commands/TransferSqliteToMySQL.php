<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
class TransferSqliteToMySQL extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'transfer-data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        

    $this->info("Starting transfer from SQLite → MySQL...");

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');


    $tables = [
        'users',
        'plans',
        'members',
        'payments',
        'audit_logs',
    ];

    foreach ($tables as $table) {

        $this->info("Transferring $table...");

        DB::table($table)->truncate();

        $rows = DB::connection('sqlite_old')->table($table)->get();

        foreach ($rows as $row) {

            $data = (array) $row;

            unset($data['id']); // avoid conflicts

            DB::table($table)->insert(array_filter($data));
        }

        $this->info("$table ✔ done");
    }
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        
    $this->info("ALL DATA MOVED SUCCESSFULLY 🚀");
}

    }

