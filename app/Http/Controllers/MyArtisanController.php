<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class MyArtisanController extends Controller
{
    /**
     * Display the list of Artisan commands.
     */
    public function index()
    {
        // extra layer of security
        if (!Auth::user()->hasRole('admin')) {
            return redirect('/')->with('error', 'You do not have access to this section.');
        }
        // Define the list of commands you want to be available
        $commands = [
            // 'key:generate',

            // 'optimize',
            'optimize:clear',
            // 'cache:clear',
            // 'config:clear',
            // 'view:clear',

            // 'config:cache',
            // 'route:cache',
            // 'view:cache',

            // 'migrate',
            // 'migrate:refresh --seed',
            // 'migrate:reset',
            // 'migrate:rollback',
            // 'migrate:fresh',

            // 'db:seed',
            
            'export:posts',
        ];

        return view('artisan.index', compact('commands'));
    }

    /**
     * Run an Artisan command.
     */
    public function run(Request $request)
    {
        if (!Auth::user()->hasRole('admin')) {
            return redirect('/')->with('error', 'You do not have access to this section.');
        }

        // Get the command from the request
        $command = $request->input('command');

        // Whitelist allowed commands
        $allowedCommands = [
            // 'key:generate',

            // 'optimize',
            'optimize:clear',
            // 'cache:clear',
            // 'config:clear',
            // 'view:clear',

            // 'config:cache',
            // 'route:cache',
            // 'view:cache',

            // 'migrate',
            // 'migrate:refresh --seed',
            // 'migrate:reset',
            // 'migrate:rollback',
            // 'migrate:fresh',

            // 'db:seed',
            
            'export:posts',
            // 'storage:link',

        ];
        if (in_array($command, $allowedCommands)) {
            Log::info("Running command: $command");

            try {
                $exitCode = Artisan::call($command);
                $output = Artisan::output();
                Log::info("Command output: $output");
                if ($exitCode === 0) {
                    return redirect()->route('artisan.index')->with('status', "Command executed successfully: $output");
                } else {
                    return redirect()->route('artisan.index')->with('error', "Command failed with exit code $exitCode: $output");
                }
            } catch (\Exception $e) {
                Log::error('Artisan command failed: ' . $e->getMessage());
                return redirect()->route('artisan.index')->with('error', 'Failed to execute command: ' . $e->getMessage());
            }
        //    Artisan::call($command);
        //     return back()->with('status', 'Command executed: ' . $command);
        }

        return redirect()->route('artisan.index')->with('error', 'Command not allowed: ' . $command);
    }
}
