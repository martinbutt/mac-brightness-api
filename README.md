A RESTful API to control the brightness of your Mac screen

Currently the only thing implemented is a "wake up" endpoint. I use this in conjuntion with Sleep As Android and Tasker to wake up my monitor slowly in the morning, gradually increasing the light level in the room.

## Installation
You need to have Composer installed: https://getcomposer.org/download/

Then run:

```
composer install
```

Next you need to test if the brightness binary works on your system.

Try:

```
bin/brightness -l
```

This should output something like:

```
display 0: main display, ID 0x7bd7f9bd
display 0: brightness 0.300781
```

If it doesn't, try compiling it with:

```
cd src
make
make install
cd ..
```

Then try this again:

```
bin/brightness -l
```

## Usage
Either install using OSX's in-built Apache web server, or use PHP's in-built web server with:

```
cd app
php -S localhost:8080 -t .
```

Now you can hit:

```
http://localhost:8080/index.php/wake
```

This will set the screen to 0 brightness and gradually increase it.

There are three options you can add to the URL:

```
level=7 // This is the level to increase the brightness to - maximum 10
rate=5 // This will increase the brightness one level every 5 seconds
display=1 // This will increase the brightness on monitor 1 - 0 is internal, 1 is external - use bin/brightness -l to see your connected monitors
```

e.g.

```
http://localhost:8080/index.php/wake?level=7&rate=5&display=1
```
