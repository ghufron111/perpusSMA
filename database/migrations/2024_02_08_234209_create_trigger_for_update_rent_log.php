<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::unprepared('
        CREATE TRIGGER `copy_to_laporan` AFTER UPDATE ON `rent_logs` 
        FOR EACH ROW 
        BEGIN

            IF NEW.actual_return_date IS NOT NULL THEN
                INSERT INTO laporan (rent_logs_id, user_id, book_id, rent_date, return_date, actual_return_date, created_at, updated_at) 
                VALUES (NEW.id, NEW.user_id, NEW.book_id, NEW.rent_date, NEW.return_date, NEW.actual_return_date, NOW(), NOW());
            END IF;

        END;
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared('DROP TRIGGER IF EXISTS copy_to_laporan');
    }
};
