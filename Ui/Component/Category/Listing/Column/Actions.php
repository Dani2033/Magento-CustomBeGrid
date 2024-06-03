<?php
/**
 * Copyright &copy; Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Drf\CustomBeGrid\Ui\Component\Category\Listing\Column;

use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\UrlInterface;
use Magento\Framework\Url;
use Magento\Ui\Component\Listing\Columns\Column;

class Actions extends Column
{
    /**
     * @var UrlInterface
     */
    protected $_urlBuilder;

    /** @var \Magento\Framework\Url */
    protected $urlHelper;

    /**
     * @var string
     */
    protected $_viewUrl;

    /**
     * @var string
     */
    protected $_editUrl;

    /**
     * Constructor
     *
     * @param ContextInterface $context
     * @param UiComponentFactory $uiComponentFactory
     * @param UrlInterface $urlBuilder
     * @param Url $urlHelper
     * @param string $viewUrl
     * @param string $editUrl
     * @param array $components
     * @param array $data
     */
    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        UrlInterface $urlBuilder,
        Url $urlHelper,
        $viewUrl = '',
        $editUrl = '',
        array $components = [],
        array $data = []
    ) {
        $this->_urlBuilder = $urlBuilder;
        $this->urlHelper = $urlHelper;
        $this->_viewUrl    = $viewUrl;
        $this->_editUrl    = $editUrl;
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }

    /**
     * FE url helper
     * 
     * @param string $routePath
     * @param array $routeParams
     * @return string
     */
    public function getFrontendUrl($routePath, $routeParams)
    {
        return $this->urlHelper->getUrl($routePath, $routeParams);
    }

    /**
     * Prepare Data Source
     *
     * @param array $dataSource
     * @return array
     */
    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as &$item) {
                $name = $this->getData('name');
                if (isset($item['entity_id'])) {
                    $item[$name]['view']   = [
                        /* 'href'  => $this->_urlBuilder->getUrl($this->_viewUrl, ['id' => $item['entity_id']]), */
                        'href'  => $this->getFrontendUrl("catalog/category/view", ['id' => $item['entity_id']]),
                        'target' => '_blank',
                        'label' => __('View on Frontend')
                    ];
                    $item[$name]['edit']   = [
                        'href'  => $this->_urlBuilder->getUrl($this->_editUrl, ['id' => $item['entity_id']]), 
                        'target' => '_blank',
                        'label' => __('Edit')
                    ];
                }
            }
        }
        return $dataSource;
    }
}
