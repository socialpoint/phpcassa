<?php
namespace phpcassa;

use phpcassa\Connection\ConnectionPool;

class Connection extends ConnectionPool {

    // Here for backwards compatibility reasons only
    public function __construct($keyspace,
                                $servers=NULL,
                                $credentials=NULL,
                                $framed_transport=true,
                                $send_timeout=5000,
                                $recv_timeout=5000,
                                $retry_time=10)
    {
        trigger_error("The Connection class has been deprecated.  Use ConnectionPool instead.",
            E_USER_NOTICE);

        if ($servers != NULL) {
            $new_servers = array();
            foreach ($servers as $server) {
                $new_servers[] = $server['host'] . ':' . (string)$server['port'];
            }
            $pool_size = count($new_servers);
        } else {
            $new_servers = NULL;
            $pool_size = NULL;
        }

        parent::__construct($keyspace, $new_servers, $pool_size,
            parent::DEFAULT_MAX_RETRIES, $send_timeout, $recv_timeout,
            parent::DEFAULT_RECYCLE, $credentials, $framed_transport);
    }

}
