<?php
/**
 * Config.php
 *
 * @copyright   Copyright (c) 2015 Yuji Iwai.
 * @version     $Id$
 *
 */


namespace Phalcon\Mvc\Router;

use Phalcon\Mvc\Router as BaseRouter;

class Config extends BaseRouter {

    /**
     * @param \Phalcon\Config|array $config
     */
    public function build($config)
    {
        $routes = $config instanceof \Phalcon\Config
            ? $config->toArray()
            : $config;

        foreach ($routes as $name => $value) {

            $names = explode('_', $name);

            $value['url'] = isset($value['url'])
                ? $value['url'] : ('/'.str_replace('_', '/', $name));

            // normalized url
            $length = strlen($value['url']);
            if ($value['url'][ $length - 1 ] === '/'
                && $length > 1 && $this->_removeExtraSlashes) {

                $value['url'] = rtrim($value['url'], '/');
            }

            $value['controller'] = isset($value['controller'])
                ? $value['controller'] : $names[0];

            if (isset($value['action'])) {
            } elseif (isset($names[1])) {
                $value['action'] = $names[1];
            } else {
                $value['action'] = 'index';
            }

            $this->add(
                $value['url'], $value
            )->setName(
                $name
            )->via(
                $value['method']
            );
        }
    }
}