pipeline {
    agent any

    stages {
        stage('Build') {
            steps {
                checkout scm
                composer install
            }
        }
        stage('Test') {
            steps {
                ./vendor/bin/phpunit
            }
        }
        stage('Deploy') {
            steps {
                echo 'WE ARE DEPLOYING'
            }
        }
    }
}
