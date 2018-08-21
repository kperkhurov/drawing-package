# drawing-package

### Installation

1) composer install

2) docker-compose up --build


### Run script

1) docker exec -ti drawing-package /bin/bash

2) ./bin/console drawing_package:draw (with default values from documentation)

3) ./bin/console drawing_package:draw --rectangle 'x=20, y=20, width=30, height=40' --square 'x=15, y=30, size=35' --ellipse 'x=100, y=150, horizontal=100, vertical=200' --circle 'x=5, y=5, size=300'
(with custom parameters)

### Run tests

1) ./bin/tests

2) There is no tests on DTO, because there is no logic

