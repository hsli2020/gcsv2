<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class Cleanup extends Command
{
    const TTL = 5*24*60*60; // 5 days

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'gcs:cleanup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Cleanup Old Data and Files';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->cleanupFolder(BASE_DIR . "/app/logs");
        $this->cleanupFolder(BASE_DIR . "/tmp");
        $this->cleanupPictures();
    }


    protected function cleanupFolder($folder)
    {
        $files = glob("$folder/*");
        foreach ($files as $file) {
            if (time() - filemtime($file) > self::TTL) {
                unlink($file);
            }
        }
    }

    protected function cleanupPictures()
    {
        $rootDir = 'C:/GCS-FTP-ROOT/';

        $arr = []; // picture-id need to be deleted

        $rows = DB::select("SELECT * FROM camera_picture");
        foreach ($rows as $row) {
            $id = $row['id'];
            $filename = $rootDir . $row['filename'];

            if (!file_exists($filename)) {
                $arr[] = $id;
                echo $id, ' ~ ', $filename, EOL;
            } else if (time() - filemtime($filename) > self::TTL) {
                $arr[] = $id;
                unlink($filename);
                echo $id, ' - ', $filename, EOL;
            }
        }

        if ($arr) {
            $ids = implode(',', $arr);
            DB::statement("DELETE FROM camera_picture WHERE id IN ($ids)");

            $sql = "SET @newid=0; UPDATE camera_picture SET id=(@newid:=@newid+1) ORDER BY id;";
            $maxid = DB::scalar("SELECT MAX(id)+1 FROM camera_picture");

            DB::statement("ALTER TABLE camera_picture AUTO_INCREMENT = $maxid");
        }
    }
}
