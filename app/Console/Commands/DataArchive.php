<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

use App\Models\Project;

class DataArchive extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'gcs:data-archive';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Data Archive';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $projects = Project::all();

        foreach ($projects as $project) {
            $this->archiveDir($project->ftpdir, $project);

            if ($project->cbdir) {
                $this->archiveDir($project->cbdir, $project);
            }
        }
    }

    protected function archiveDir($ftpdir, $project)
    {
        $projectName = str_replace(' ', '_', $project->name);

        $files = [];

        $dir = 'C:/FTP-Backup/' . basename($ftpdir);
        foreach (glob($dir . '/*.log.csv') as $filename) {
            $files[$filename] = filemtime($filename);
        }
        asort($files);

        echo $project->name, ' ', count($files), ' files', EOL;

        if (count($files) == 0) {
            return;
        }

        $handles = [];
        $zipfiles = [];
        foreach (array_keys($files) as $filename) {
            echo "$filename\r";

            // filename: c:\FTP-Backup\125Bermondsey_001EC6053434\mb-001.57BEE4B7_1.log.csv
            $parts = explode('.', basename($filename));
            $dev = $parts[0]; // mb-001

            $isNewFile = false;
            if (isset($handles[$dev])) {
                $dst = $handles[$dev];
            } else {
                $archiveFilename = "C:/FTP-Backup/archive/$projectName-$dev.csv";
                if (file_exists($archiveFilename)) {
                    $dst = fopen($archiveFilename, 'a');
                } else {
                    $isNewFile = true;
                    $dst = fopen($archiveFilename, 'w');
                }
                $handles[$dev] = $dst;
            }

            // Merge the file into a single big file
            $src = fopen($filename, 'r');

            $title = fgets($src);
            if ($isNewFile) {
                fputs($dst, $title);
            }

            while ($line = fgets($src)) {
                fputs($dst, $line);
            }
            fclose($src);

            // Pack the file into a zip file
            if (isset($zipfiles[$dev])) {
                $zip = $zipfiles[$dev];
            } else {
                $zipFilename = "C:/FTP-Backup/archive/$projectName-$dev.zip";

                $zip = new \ZipArchive;
                if ($zip->open($zipFilename, \ZipArchive::CREATE) !== TRUE) {
                    echo "Failed to open zip file $zipFilename\n";
                    continue;
                }

                $zipfiles[$dev] = $zip;
            }

            $zip->addFile($filename, basename($filename));
        }

        foreach ($handles as $handle) {
            fclose($handle);
        }

        foreach ($zipfiles as $zip) {
            $zip->close();
        }

        // delete files after zip files created and closed
        foreach (array_keys($files) as $filename) {
            unlink($filename);
        }

        echo EOL;
    }
}
