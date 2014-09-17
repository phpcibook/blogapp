# config valid only for Capistrano 3.1

set :application, 'blogapp'
set :repo_url, 'git@github.com:phpcibook/blogapp.git'
set :deploy_to, '/var/www/application'
set :linked_dirs, %w{tmp/cache tmp/cache/models tmp/cache/persistent tmp/cache/views tmp/logs tmp/sessions tmp/tests}
set :linked_files, %w{production.php}
set :log_level, :info

framework_tasks = ["symlink:linked_dirs", "symlink:linked_files"]
framework_tasks.each do |t|
  Rake::Task["deploy:#{t}"].clear
end
set :password, ask('Server password:', nil)

namespace :deploy do
  before :check, :create_app_dir do
    on release_roles :app do |role|
      execute :sudo, :mkdir, '-p', '/var/www/application'
      execute :sudo, :chown, "#{host.user}:#{role.properties.group}", '/var/www/application'
    end
  end

  namespace :check do
    after :linked_dirs, :chown_linked_dirs do
      on release_roles :app do |role|
         execute :sudo, :find, shared_path, "-type d -print", "|", :xargs, :chmod, "777"
      end
    end

    before :linked_files, :upload_app_config do
      on release_roles :app do |role|
        if (role.properties.app_config.instance_of?(String)) then
          upload! "./config/deploy/#{role.properties.app_config}", shared_path
        end
      end
    end
  end

  after :updated, :composer_install do 
    on roles(:app) do
      execute :composer, "--working-dir=#{release_path}/app", "--no-dev", :install
    end
  end

  after :updated, :migrate do
    on release_roles :db do |role|
      cake_env = role.properties.cake_env

      execute "env CAKE_ENV=#{cake_env} #{release_path}/app/Console/cake Migrations.migration run all -p"
    end
  end

  namespace :symlink do
    task :linked_files do
      on release_roles :app do |role|
        if (role.properties.app_config.instance_of?(String)) then
          target = release_path.join("app/Config/bootstrap/environments/#{role.properties.app_config}")
          source = shared_path.join(role.properties.app_config)
          execute :ln, '-s', source, target
        end
      end
    end

    task :linked_dirs do
      on release_roles :app do
        target = release_path.join('app/tmp')
        source = shared_path.join('tmp')
        execute :sudo, :rm, '-rf', target
        execute :ln, '-s', source, target
      end
    end
  end

  after :published, :restart_php_fpm do
    on release_roles :app do |role|
      execute :sudo, :service, 'php5-fpm', :restart
    end
  end
end
