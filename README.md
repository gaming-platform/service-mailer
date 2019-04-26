# service-mailer

__Please don't use this service on your projects.
It will have breaking changes.
It is built exclusively for this platform.__

This service provides mail system for the
[gaming platform](https://github.com/gaming-platform).

## Installation and requirements

I recommend to use
[Docker](https://www.docker.com),
[Docker Compose](https://docs.docker.com/compose/).
You can also set up a stack yourself.

### Development

```
git clone https://github.com/gaming-platform/service-mailer
cd service-mailer
./project build
```

There're several other handy commands in the project script, like running tests. You see them with

```
./project help
```

Following urls are accessible after the project is successfully started.

| URL                                              | Information                 |
|--------------------------------------------------|-----------------------------|
| [http://localhost/](http://localhost/)           | The application.            |
| [http://localhost:8081/](http://localhost:8081/) | MySQL management interface. |

### Production

The
[production image](https://hub.docker.com/r/gamingplatform/service-mailer)
is built when pushed to git master. They always reflect the latest stable version.

## Endpoints

WIP
