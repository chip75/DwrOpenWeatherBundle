
## 2.0 2017-03-01
### Added
- New weather provider: OpenWeather
- Compatibility with Symfony 3.x
- Compatibility with PHP 5.6 and PHP 7.
- Removed GobalWeather provider

### Changed
- Change weather API provider from Globalweather to OpenWeather
GlobalWeather seems to have some issues and we can not relay on it anymore.
So I decided to leave supporting GlobalWeather SOAP API and switch to RESTFUL OpenWeather.
More details about OpenWeather you may find [here](http://openweathermap.org/).

## ~~1.0 - 2015-12-03~~
### ~~Added~~
- ~~Weather provider GlobalWeather~~.
- ~~ompatibility with Symfony 2.x~~

_Please, do not use version 1.0. GlobalWeather seems to have some issues and we can not relay on it anymore._