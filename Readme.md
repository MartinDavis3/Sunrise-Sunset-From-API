# Sunrise Sunset From API

The public API https://api.sunrise-sunset.org/json is used to get sunrise, sunset and related information for a location given by the user. This retrieved information is then displayed to the user.

The current version requires the user to input continent and city names. If the continent/city pair is recognised  (i.e. it forms valid input for the PHP DateTimeZone constructor) the data is retrieved from the API, otherwise the user is informed that this continent/city pair was not recognised.
