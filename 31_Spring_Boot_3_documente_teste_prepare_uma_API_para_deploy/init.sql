CREATE DATABASE IF NOT EXISTS vollmed_api_test;
CREATE DATABASE IF NOT EXISTS vollmed_api;

GRANT ALL PRIVILEGES ON vollmed_api.* TO 'app_user'@'%';
GRANT ALL PRIVILEGES ON vollmed_api_test.* TO 'app_user'@'%';
FLUSH PRIVILEGES;