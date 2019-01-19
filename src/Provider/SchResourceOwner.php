<?php
/**
 * This file is part of the wohali/oauth2-discord-new library
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @copyright Copyright (c) Joan Touzet <code@atypical.net>
 * @license http://opensource.org/licenses/MIT MIT
 * @link https://packagist.org/packages/wohali/oauth2-discord-new Packagist
 * @link https://github.com/wohali/oauth2-discord-new GitHub
 */
namespace App\Provider;
use League\OAuth2\Client\Provider\ResourceOwnerInterface;
use League\OAuth2\Client\Tool\ArrayAccessorTrait;
class SchResourceOwner implements ResourceOwnerInterface
{
    use ArrayAccessorTrait;
    /**
     * Raw response
     *
     * @var array
     */
    protected $response;
    /**
     * Creates new resource owner.
     *
     * @param array  $response
     */
    public function __construct(array $response = array())
    {
        $this->response = $response;
    }
    /**
     * Get resource owner ID
     *
     * @return string|null
     */
    public function getId()
    {
        return $this->getValueByKey($this->response, 'id');
    }
    /**
     * Get resource owner username
     *
     * @return string|null
     */
    public function getUsername()
    {
        return $this->getValueByKey($this->response, 'basic');
    }
    /**
     * Get resource owner username
     *
     * @return string|null
     */
    public function getName()
    {
        return $this->getValueByKey($this->response, 'displayName');
    }
    /**
     * Get resource owner email
     *
     * @return string|null
     */
    public function getEmail()
    {
        return $this->getValueByKey($this->response, 'mail');
    }
    /**
     * Returns the raw resource owner response.
     *
     * @return array
     */
    public function toArray()
    {
        return $this->response;
    }
}
