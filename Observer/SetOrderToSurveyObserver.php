<?php
/**
 * @author Nwhales Team
 *
 * @copyright Copyright (c) 2019 Nwhales (https://www.nwhales.com)
 */

namespace Nwhales\GoogleReviews\Observer;

use Magento\Framework\Event\Observer as EventObserver;
use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\View\LayoutInterface;

class SetOrderToSurveyObserver implements ObserverInterface
{
    /** @var LayoutInterface  */
    private $layout;

    public function __construct(LayoutInterface $layout)
    {
        $this->layout = $layout;
    }

    /**
     * @param EventObserver $observer
     */
    public function execute(EventObserver $observer)
    {
        $orderIds = $observer->getEvent()->getOrderIds();
        if (empty($orderIds) || !is_array($orderIds)) {
            return;
        }

        /** @var \Nwhales\GoogleReviews\Block\Survey|null $block */
        $block = $this->layout->getBlock('nwhales.google_reviews.survey');
        if ($block) {
            $block->setOrderIds($orderIds);
        }
    }
}
