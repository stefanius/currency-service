<?php

namespace Stef\CurrencyServiceBundle\ListView;

use Stef\SimpleCmsBundle\ListView\AbstractListView;

class DefaultOptionsListView extends AbstractListView
{
    protected function initProperties()
    {
        return [
            'currencyDisplayName',
            'currencyServiceCode'
        ];
    }

    protected function initHeaders()
    {
        return [
            'id' => 'ID',
            'currencyDisplayName' => 'Name',
            'currencyServiceCode' => 'Code'
        ];
    }

}