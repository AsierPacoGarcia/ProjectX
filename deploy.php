<?php
namespace Deployer;

require 'recipe/symfony.php';

// Config
set('aplication','projectx');
set('keep_releases', 10);
set('writable_use_sudo', false);

//Shared files
add('shared_files', []);
add('shared_dirs', []);
add('writable_dirs', []);

// Hosts
host('ec2-18-100-56-8.eu-south-2.compute.amazonaws.com')
    ->set('remote_user', 'root')
    ->set('deploy_path', '/var/www/dev/projectx/deploy')
    ->set('bin/php', '/usr/bin/php');

// Rewrite deploy task:

task('deploy', [
    'deploy:info',
    'deploy:prepare',
    'deploy:lock',
    'deploy:release',
    'deploy:shared',
    'deploy:vendors',
    'deploy:cache:clear',
    'deploy:symlink',
    'deploy:unlock'
])->desc('Deploy your project');

// Hooks
after('deploy:failed', 'deploy:unlock');
