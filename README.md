# zend-server-url-callback
A php script to be used for Zend Server events callback. Usefull  for integrations.

To use it, you must enable the URL Call on events. 

Go to Monitoring > Setting > Events. On the 'Triggered Actions Settings' section, insert the url of the 'events_triage.php' and check the 'Apply to existing monitor rules' checkbox.


Then, go to 'Monitoring > Event Rules' and click on the event you want to integrate, then on the Event Rule details page, check the 'Call URL' checkbox on the event you want to integrate.

## Integration 

The integration with the ticketing system must be implemented, you may implement it on the 'openNewTicket()' function on the script. It may be an API call or a send e-mail type of integration. This logic is up to you to implement.

## Info of the event

The event details that has triggered the callback will be available on the $_POST variable.
