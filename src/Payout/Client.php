<?php
/*
 * The MIT License
 *
 * Copyright (c) 2019 Payout, s.r.o. (https://payout.one/)
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 * SOFTWARE.
 */

namespace Payout;

use Exception;

/**
 * Class Client
 *
 * The Payout API Client PHP Library.
 * https://postman.payout.one/
 *
 * @package    Payout
 * @version    0.1.0
 * @copyright  2019 Payout, s.r.o.
 * @author     Neotrendy s. r. o.
 * @link       https://github.com/payout-one/payout_php
 */
class Client
{
    const LIB_VER = "0.1.0";
    const API_URL = 'https://ie.payout.one/api/v1/';

    /**
     * @var array $config API client configuration
     * @var string $token Obtained API access token
     * @var Connection $connection Connection instance
     */
    private $config, $token, $connection;

    /**
     * Construct the Payout API Client.
     *
     * @param array $config
     * @throws Exception
     */
    public function __construct(array $config = array())
    {
        if (!function_exists('curl_init')) {
            throw new Exception('Payout needs the CURL PHP extension.');
        }
        if (!function_exists('json_decode')) {
            throw new Exception('Payout needs the JSON PHP extension.');
        }

        $this->config = array_merge(
            [
                'client_id' => '',
                'client_secret' => '',
                'store_url'
            ],
            $config
        );
    }

    /**
     * Get a string containing the version of the library.
     *
     * @return string
     */
    public function getLibraryVersion()
    {
        return self::LIB_VER;
    }

    /**
     * Get an instance of the HTTP connection object. Initializes
     * the connection if it is not already active.
     * Authorize connection and obtain access token.
     *
     * @return Connection
     * @throws Exception
     */
    private function connection()
    {
        if (!$this->connection) {
            $this->connection = new Connection(self::API_URL);
            $this->token = $this->connection->authenticate('authorize', $this->config['client_id'], $this->config['client_secret']);
        }

        return $this->connection;
    }

    public function createCheckout($data)
    {
        $checkout = new Checkout();
        $prepared_checkout = $checkout->create($data);
        $response = $this->connection()->post("checkouts", $prepared_checkout);
        return $response;
    }
}