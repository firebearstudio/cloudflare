<?php

namespace Cloudflare;

/**
 * CloudFlare API wrapper
 *
 * Zone
 * A Zone is a domain name along with its subdomains and other identities
 *
 * @author James Bell <james@james-bell.co.uk>
 * @version 1
 */

class Zone extends Api
{
    /**
     * Default permissions level
     * @var array
     */
    protected $permission_level = array('read' => '#zone:read', 'edit' => '#zone:edit');

    /**
     * Create a zone (permission needed: #zone:edit)
     *
     * @param      $name
     * @param null $jump_start
     * @param null $organization
     *
     * @return array
     */
    public function create($name, $jump_start = null, $organization = null)
    {
        $data = array(
            'name'         => $name,
            'jump_start'   => $jump_start,
            'organization' => $organization
        );
        return $this->post('zones', $data);
    }

    /**
     * Initiate another zone activation check (permission needed: #zone:edit)
     *
     * @param $identifier
     *
     * @return array
     */
    public function activation_check($identifier) {
        return $this->put('zones/' . $identifier . '/activation_check');
    }

    /**
     * List zones (permission needed: #zone:read)
     * List, search, sort, and filter your zones
     *
     * @param null $name
     * @param null $status
     * @param null $page
     * @param null $per_page
     * @param null $order
     * @param null $direction
     * @param null $match
     *
     * @return array
     */
    public function zones($name = null, $status = null, $page = null, $per_page = null, $order = null, $direction = null, $match = null)
    {
        $data = array(
            'name'      => $name,
            'status'    => $status,
            'page'      => $page,
            'per_page'  => $per_page,
            'order'     => $order,
            'direction' => $direction,
            'match'     => $match
        );
        return $this->get('zones', $data);
    }

    /**
     * Zone details (permission needed: #zone:read)
     *
     * @param $zone_identifier
     *
     * @return array
     */
    public function zone($zone_identifier)
    {
        return $this->get('zones/' . $zone_identifier);
    }

    /**
     * Pause all CloudFlare features (permission needed: #zone:edit)
     * This will pause all features and settings for the zone. DNS will still resolve
     * @param string $zone_identifier API item identifier tag
     */
    public function pause($zone_identifier)
    {
        return $this->put('zones/' . $zone_identifier . '/pause');
    }

    /**
     * Re-enable all CloudFlare features (permission needed: #zone:edit)
     * This will restore all features and settings for the zone
     * @param string $zone_identifier API item identifier tag
     */
    public function unpause($zone_identifier)
    {
        return $this->put('zones/' . $zone_identifier . '/unpause');
    }

    /**
     * Delete a zone (permission needed: #zone:edit)
     * @param string $zone_identifier API item identifier tag
     */
    public function delete_zone($zone_identifier)
    {
        return $this->delete('zones/' . $zone_identifier);
    }

}
