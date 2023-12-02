pipeline {
    agent any

    environment {
        IMAGE_NAME = 'doducmanh3000/jenkins-docker-example'
    }

    stages {
        stage('Checkout') {
            steps {
                script {
                    checkout scm
                }
            }
        }

        stage('Build and Push Docker Image') {
            steps {
                script {
                    // Build Docker image
                    docker.build(env.IMAGE_NAME, '.docker/php')

                    // Authenticate with Docker Hub
                    docker.withRegistry('https://index.docker.io/v1/', 'dockerhub') {
                        // Push Docker image to Docker Hub
                        docker.image(env.IMAGE_NAME).push()
                    }
                }
            }
        }

        stage('Deploy') {
            steps {
                script {
                    // Your deployment steps here
                    // For example, pull the latest image and run a container
                    // sh "docker pull ${env.IMAGE_NAME}"
                    // sh "docker run -d --name your-container-name -p 80:80 ${env.IMAGE_NAME}"
                    echo 'Deploying...'
                }
            }
        }
    }
}
