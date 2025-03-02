<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Spatie\Backup\BackupDestination\Backup;
use Spatie\Backup\BackupDestination\BackupDestination;
use Spatie\Backup\Tasks\Backup\BackupJob;
use Symfony\Component\Process\Process;
use Illuminate\Contracts\Filesystem\Factory as FilesystemFactory;
use Validator;


class AdminController extends Controller
{
    public function __construct() {
//        $this->middleware('auth', ['except' => ['index', 'checklogin']]);
    }
    public function index()
    {
        return view('admin.auth.login');
    }
    public function checklogin(Request $request)
    {
        $this->validate($request, [
            'email'   => 'required|email',
            'password'  => 'required|min:3'
        ]);

        $user_data = array(
            'email'  => $request->get('email'),
            'password' => $request->get('password')
        );

        if(Auth::attempt($user_data))
        {
            return redirect('main/successlogin');
        }
        else
        {
            return back()->with('error', 'Wrong Login Details');
        }

    }

    public function successlogin()
    {
        return view('admin.auth.successlogin');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('main');
    }
    public function downloadDb(FilesystemFactory $filesystemFactory)
    {
        $process = new Process(['php', 'artisan', 'backup:run']);
        $process->setWorkingDirectory(base_path());
        $process->run();

        if ($process->isSuccessful()) {
            $disk = 's3_db_backup';
            $dir = 'Laravel';
            $files = Storage::disk('s3_db_backup')->files($dir);
            usort($files, function ($a, $b) use ($disk) {
                $timeA = Storage::disk($disk)->lastModified($a);
                $timeB = Storage::disk($disk)->lastModified($b);
                return $timeA < $timeB ? 1 : -1;
            });
            $filesToKeep = array_slice($files, 0, 2);
            $filesToDelete = array_slice($files, 2);
//            foreach ($filesToDelete as $fileToDelete) {
//                Storage::disk($disk)->delete($fileToDelete);
//            }
        $latestFile = array_shift($filesToKeep);
//        return response([$files, $filesToKeep, $filesToDelete, $latestFile]);
        return Storage::disk($disk)->download($latestFile);
//            return response([$files, $filesToKeep, $latestFileUrl]);
        }
        else {
            // Handle the case where the backup command failed
            return response( $process->getErrorOutput());
        }
    }
}
