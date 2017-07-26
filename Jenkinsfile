pipeline {
    agent any

    stages {
        stage('Build') {
            steps {
                checkout scm
                sh 'composer install'
            }
        }
        stage('Test') {
            steps {
                sh './vendor/bin/phpunit'
            }
        }
        stage('Deploy') {
            steps {
                echo 'WE ARE DEPLOYING'
            }
        }
    }
}
