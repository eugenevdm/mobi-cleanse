## Mobi Cleanse - A Mobile Telephone Number Cleanser

Mobi Cleanse is a web application that allows you to sanitise mobile telephone numbers.

This could be useful if you are trying to send SMSses and you are not sure if you have the correct number.

The application let's you upload a CSV file containing IDs and mobile phone numbers, or access the API directly so that you can sanitise individual numbers.

## Using Mobi Cleanse

There are three ways to use Mobi Cleanse:

1. Use our demo system's web interface at http://mobi-cleanse.gatewaymodules.com/
2. Use the API endpoint at http://mobi-cleanse.gatewaymodules.com/api/cleanse/{number}, e.g. http://mobi-cleanse.gatewaymodules.com/check/0823096710
2. Install the Laravel Application on your localhost

The quickest way is to visit our demo site at http://mobi-cleanse.gatewaymodules.com/

The username and password to access this system is:

Username: `user@domain.com`

Password: `demo12`

## Configuration File

By default Mobi Cleanse is configured to work with South African numbers (27 calling code).

If you want to adapt MobiCleanse to another country, edit `/config/app.php` and specify:

### Calling Code ###
`calling_code`

Change 27 to your country code.

### Mobile Prefixes ###
`mobile_prefixes`

Every country has it's own mobile prefixes. South Africa's is documented here:
https://en.wikipedia.org/wiki/Telephone_numbers_in_South_Africa

Use the `'mobile_prefixes' =>` array in `/config/app.php` to specify your country's specific mobile prefixes.

The `checkPrefix` method in the `Numbers` facade checks the array for 3 or 4 digits prefixes. Modify this function if your country uses different length prefixes.

## API Results

If you access the API, you will get a JSON encoded value containing information about the test. For example:

http://mobi-cleanse.gatewaymodules.com/check/0823096710 returns:

> {
>
> "output":"27823096710",
>
> "state":"success",
>
> "correction":"added country code and removed 0"
>
>
> }

`output` is the cleansed number.

`state` can be `success`, `error`, or `warning` and `correction` will contain a human readable message if the operation succeeded or not.

## To Do

* API rate limiting
* Ajax file uploading
* Progress bar file upload indicator
* Modify `checkPrefix` to work with any length prefix

## Support

Please direct any comments or issues to eugenevdm@gmail.com

## License

This software is licensed under the [MIT license](http://opensource.org/licenses/MIT).
