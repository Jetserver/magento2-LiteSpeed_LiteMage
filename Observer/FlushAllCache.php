<?php
/**
 * LiteMage
 *
 * NOTICE OF LICENSE
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 *  You should have received a copy of the GNU General Public License
 *  along with this program.  If not, see https://opensource.org/licenses/GPL-3.0 .
 *
 * @package   LiteSpeed_LiteMage
 * @copyright  Copyright (c) 2016 LiteSpeed Technologies, Inc. (https://www.litespeedtech.com)
 * @license     https://opensource.org/licenses/GPL-3.0
 */


namespace Litespeed\Litemage\Observer;

use Magento\Framework\Event\ObserverInterface;

class FlushAllCache implements ObserverInterface
{

    /**
     * @var \Litespeed\Litemage\Model\CacheControl
     */
    protected $litemageCache;

    /**
     * @var \Magento\Framework\App\Action\Context
     */
    protected $context;

    /**
     * @param \Litespeed\Litemage\Model\CacheControl $litemageCache
     * @param \Magento\Framework\App\Action\Context $context
     */
    public function __construct(\Litespeed\Litemage\Model\CacheControl $litemageCache,
            \Magento\Framework\App\Action\Context $context)
    {
        $this->litemageCache = $litemageCache;
        $this->context = $context;
    }

    /**
     * Flush Litemage cache
     * @param \Magento\Framework\Event\Observer $observer
     * @return void
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        if ($this->litemageCache->moduleEnabled()) {
            $this->litemageCache->addPurgeTags('*');
            $this->messageManager = $this->context->getMessageManager();
            $this->messageManager->addSuccess('litemage purge all');
            $this->litemageCache->debugLog('purge all invoked');
        }
    }

}
