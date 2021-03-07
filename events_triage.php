<?php 
 /*
 *  Details of information passed via $_POST directive:
 * 
 *  {
 *     ["EVENT_ID"]=>
 *     string(4) "3986"
 *     ["EVENT_DATA"]=>
 *     string(1942) "{
 *       "issueId":	3986,
 *       "ruleName":	"Slow Request Execution",
 *       "eventType":	"request-slow-exec",
 *       "severity":	"severe",
 *       "url":	"http: *server-url/",
 *       "script":	"",
 *       "line":	0,
 *       "errorString":	"",
 *       "backtrace":	[],
 *       "superGlobals":	{
 *           "GET":	{
 *           },
 *           "POST":	{
 *           },
 *           "COOKIES":	{
 *           },
 *           "SERVER":	{
 *               "SCRIPT_URL":	"/",
 *               "SCRIPT_URI":	"http: *server-url/",
 *               "HTTP_HOST":	"server-url",
 *               "HTTP_CONNECTION":	"keep-alive",
 *               "HTTP_UPGRADE_INSECURE_REQUESTS":	"1",
 *               "HTTP_ACCEPT":	"text/html,application/xhtml xml,application/xml;q=0.9,*\/*;q=0.8",
 *               "HTTP_USER_AGENT":	"Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_6) AppleWebKit/605.1.15 (KHTML, like Gecko) Ve...cut...",
 *               "HTTP_REFERER":	"http: *server-url/",
 *               "HTTP_ACCEPT_LANGUAGE":	"pt-br",
 *               "HTTP_ACCEPT_ENCODING":	"gzip, deflate",
 *               "PATH":	"/usr/local/sbin:/usr/local/bin:/usr/sbin:/usr/bin:/sbin:/bin:/snap/bin",
 *               "SERVER_SIGNATURE":	"<address>Apache/2.4.29 (Ubuntu) Server at server-url Port 80</address>\n",
 *               "SERVER_SOFTWARE":	"Apache/2.4.29 (Ubuntu)",
 *               "SERVER_NAME":	"server-url",
 *               "SERVER_ADDR":	"167.172.149.4",
 *               "SERVER_PORT":	"80",
 *               "REMOTE_ADDR":	"24.152.15.44",
 *               "DOCUMENT_ROOT":	"/var/www/html",
 *               "REQUEST_SCHEME":	"http",
 *               "CONTEXT_PREFIX":	"",
 *               "CONTEXT_DOCUMENT_ROOT":	"/var/www/html",
 *               "SERVER_ADMIN":	"webmaster@localhost",
 *               "SCRIPT_FILENAME":	"/var/www/html/index.php",
 *               "REMOTE_PORT":	"60907",
 *               "GATEWAY_INTERFACE":	"CGI/1.1",
 *               "SERVER_PROTOCOL":	"HTTP/1.1",
 *               "REQUEST_METHOD":	"GET",
 *               "QUERY_STRING":	"",
 *               "REQUEST_URI":	"/",
 *               "SCRIPT_NAME":	"/index.php",
 *               "PHP_SELF":	"/index.php",
 *               "REQUEST_TIME_FLOAT":	1615149911,
 *               "REQUEST_TIME":	1615149911
 *           }
 *       }
 *   }"
 *   }
 */


/*
 *  DEFINE VARIABLES
 */
$eventData = json_decode($_POST['EVENT_DATA']);
$eventType = $eventData->eventType;
$eventUrl = $eventData->url;
$eventDefinition = "{$eventType}-{$eventUrl}".PHP_EOL;     // E.g.: string() "request-slow-exec-http://url"
$filelog = 'tickets.txt';
/*
 * OPEN TICKET ON THE ISSUE IF NOT ALREADY OPENED
 */
if(!ticketExists($eventDefinition,$filelog)) {
    updateCurrentListOfOpenedTickets($eventDefinition,$filelog);
    openNewTicket($eventDefinition,$filelog);
}

/*
 * CHECK IF THERE IS OPENED TICKET ON THE ISSUE
 */
function ticketExists($eventDefinition,$filelog){
    $fn = fopen($filelog,"r+");
    while(! feof($fn))  {
      $result = fgets($fn);
      if($result == $eventDefinition) {
          return true;
      }
    }
    fclose($fn);   
    return false;
}

/*
 * OPEN NEW TICKET
 */
function openNewTicket($eventDefinition,$filelog){
    // TODO: Integrate with Nagios API or sendmail() or any other.
}

/*
 *
 */
function updateCurrentListOfOpenedTickets($eventDefinition,$filelog){
    $result = file_put_contents($filelog, $eventDefinition, FILE_APPEND);   
}