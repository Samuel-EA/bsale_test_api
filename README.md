# Welcome

Welcome to bsale frontend.

#Objetive

Determine if candidate is able to interact with databases through a web application implementing both client and server app to measure his skills

#Task

Create a web store that displays products grouped by category using available database provided by recruiter

## Developers Guide

I order to run this project properly please follow the steps down below:

#For Ubuntu

**Get Docker CE for Ubuntu**

To get started with Docker CE on Ubuntu, make sure you meet the prerequisites, then install Docker.

**OS requirements**

To install Docker CE, you need the 64-bit version of one of these Ubuntu versions or the latest:

* Bionic 18.04 (LTS)
* Xenial 16.04 (LTS)
* Trusty 14.04 (LTS)

Notice, if you have old docker versions follow the next step.

Older versions of Docker were called docker or docker-engine. If these are installed, uninstall them:
```
    $ sudo apt-get remove docker docker-engine docker.io
```

It’s OK if apt-get reports that none of these packages are installed.

**Install using the repository**

Before you install Docker CE for the first time on a new host machine, you need to set up the Docker repository. Afterward, you can install and update Docker from the repository.

**SET UP THE REPOSITORY**

1.- Update the apt package index

```
    $ sudo apt-get update
```

2.- Install packages to allow apt to use a repository over HTTPS:

```
    $ sudo apt-get install \
        apt-transport-https \
        ca-certificates \
        curl \
        software-properties-common
```

3.- Add Docker’s official GPG key:

```
    $ curl -fsSL https://download.docker.com/linux/ubuntu/gpg | sudo apt-key add -
```

   4.- Use the following command to set up the stable repository. You always need the stable repository, even if you want to install builds from the edge or test repositories as well. To add the edge or test repository, add the word edge or test (or both) after the word stable in the commands below.

```
    $ sudo add-apt-repository \
       "deb [arch=amd64] https://download.docker.com/linux/ubuntu \
       $(lsb_release -cs) \
       stable"
```

**INSTALL DOCKER CE**

1.- Update the apt package index

```
    $ sudo apt-get update
```

2.- Install the latest version of Docker CE, or go to the next step to install a specific version:

```
    $ sudo apt-get install docker-ce
```

**Create docker container in Ubuntu OS**

First, you need to create "app" and "mysql" directories at "/home/user/"

Then run the next command as superuser in terminal:

```
    $ sudo docker run --name="lamp" -i -t -p 3306:3306 -p "80:80" -v ${PWD}/app:/app -v ${PWD}/mysql:/var/lib/mysql mattrayner/lamp:latest-1804
```

Go ahead and try to clone this repository:

```
    $ cd ${PWD}/app && git clone https://github.com/Samuel-EA/bsale_test_api.git
```

#For Windows

**Install XAMPP for windows with PHP 7.4.28**

Then clone this repository in htdocs folder

#For testing it's recommended use Postman but you could use any application of your choice


## Documentation
All requests are made using JSON format

**Get all products **
POST http://bsaletestapisamuelea-env.eba-bm2h4qb2.us-east-2.elasticbeanstalk.com/product/getAllProducts.php

Enpoint that fetch all products in table with pagination

```
    {\"data\":[{\"id\":\"50\",\"name\":\"SPRITE 2 Lt\",\"url_image\":\"https:\\/\\/dojiw2m9tvv09.cloudfront.net\\/11132\\/product\\/sprite-2lt4365.jpg\",\"price\":\"1800\",\"discount\":\"0\",\"category\":\"4\"},{\"id\":\"48\",\"name\":\"SPRITE 1 1\\/2 Lts\",\"url_image\":\"https:\\/\\/dojiw2m9tvv09.cloudfront.net\\/11132\\/product\\/sprite-lata-33cl5575.jpg\",\"price\":\"1500\",\"discount\":\"0\",\"category\":\"4\"},{\"id\":\"33\",\"name\":\"RON PAMPERO ANIVERSARIO\",\"url_image\":\"https:\\/\\/dojiw2m9tvv09.cloudfront.net\\/11132\\/product\\/ron_pampero_aniversario0311.jpg\",\"price\":\"20000\",\"discount\":\"15\",\"category\":\"3\"},{\"id\":\"32\",\"name\":\"RON PAMPERO\",\"url_image\":\"https:\\/\\/dojiw2m9tvv09.cloudfront.net\\/11132\\/product\\/pampero-especial0296.jpg\",\"price\":\"5490\",\"discount\":\"20\",\"category\":\"3\"},{\"id\":\"39\",\"name\":\"RON MITJANS\",\"url_image\":\"https:\\/\\/dojiw2m9tvv09.cloudfront.net\\/11132\\/product\\/mitjan6396.jpg\",\"price\":\"2990\",\"discount\":\"0\",\"category\":\"3\"},{\"id\":\"31\",\"name\":\"RON HAVANA ESPECIAL\",\"url_image\":\"https:\\/\\/dojiw2m9tvv09.cloudfront.net\\/11132\\/product\\/havanaespecial9768.jpg\",\"price\":\"5990\",\"discount\":\"20\",\"category\":\"3\"},{\"id\":\"30\",\"name\":\"RON HAVANA A\ÑEJO RESERVA\",\"url_image\":\"https:\\/\\/dojiw2m9tvv09.cloudfront.net\\/11132\\/product\\/havanaan-ejo9750.jpg\",\"price\":\"6990\",\"discount\":\"0\",\"category\":\"3\"},{\"id\":\"29\",\"name\":\"RON FLOR DE CA\ÑA 5 A\ÑOS\",\"url_image\":\"https:\\/\\/dojiw2m9tvv09.cloudfront.net\\/11132\\/product\\/flor59677.jpg\",\"price\":\"4590\",\"discount\":\"0\",\"category\":\"3\"},{\"id\":\"28\",\"name\":\"RON FLOR DE CA\ÑA 4 A\ÑOS\",\"url_image\":\"https:\\/\\/dojiw2m9tvv09.cloudfront.net\\/11132\\/product\\/flor49664.jpg\",\"price\":\"3990\",\"discount\":\"0\",\"category\":\"3\"},{\"id\":\"38\",\"name\":\"RON BOTRAN A\ÑEJO 5 A\ÑOS\",\"url_image\":\"https:\\/\\/dojiw2m9tvv09.cloudfront.net\\/11132\\/product\\/ronbotran9337.jpg\",\"price\":\"4990\",\"discount\":\"0\",\"category\":\"3\"}],\"records\":\"10\",\"page\":\"1\",\"pages\":6,\"total\":\"57\",\"limit\":0,\"first\":1,\"previous\":1,\"next\":2,\"last\":6,\"start\":1,\"end\":6}"
```



Have fun!

