<?php

namespace Processton\Locale\Controllers;

use Processton\Locale\Filament\Resources\CityResource\Widgets\CityCountsWidget;
use Processton\Locale\Filament\Resources\CountryResource\Widgets\CountryCountWidget;
use Processton\Locale\Filament\Resources\RegionResource\Widgets\RegionCountWidget;
use Processton\Locale\Filament\Resources\ZoneResource\Widgets\ZonesCountWidget;

class WidgetsController extends Controller
{
    public function getCitiesCount()
    {

        $widget = CityCountsWidget::getStat();

        return response()->json([
            'extraAttributes' => $widget->getExtraAttributes(),
            'chart' => $widget->getChart(),
            'chartColor' => $widget->getChartColor(),
            'color' => $widget->getColor(),
            'icon' => $widget->getIcon(),
            'description' => $widget->getDescription(),
            'descriptionIcon' => $widget->getDescriptionIcon(),
            'descriptionIconPosition' => $widget->getDescriptionIconPosition(),
            'descriptionColor' => $widget->getDescriptionColor(),
            'shouldOpenUrlInNewTab' => $widget->shouldOpenUrlInNewTab(),
            'url' => $widget->getUrl(),
            'id' => $widget->getId(),
            'label' => $widget->getLabel(),
            'value' => $widget->getValue()
        ]);

    }

    public function getCountiesCount(){

        $widget = CountryCountWidget::getStat();

        return response()->json([
                'extraAttributes'=> $widget->getExtraAttributes(),
                'chart' => $widget->getChart(),
                'chartColor' => $widget->getChartColor(),
                'color' => $widget->getColor(),
                'icon' => $widget->getIcon(),
                'description' => $widget->getDescription(),
                'descriptionIcon' => $widget->getDescriptionIcon(),
                'descriptionIconPosition' => $widget->getDescriptionIconPosition(),
                'descriptionColor' => $widget->getDescriptionColor(),
                'shouldOpenUrlInNewTab' => $widget->shouldOpenUrlInNewTab(),
                'url' => $widget->getUrl(),
                'id' => $widget->getId(),
                'label' => $widget->getLabel(),
                'value' => $widget->getValue()
        ]);
    }

    public function getRegionsCount()
    {

        $widget = RegionCountWidget::getStat();

        return response()->json([
            'extraAttributes' => $widget->getExtraAttributes(),
            'chart' => $widget->getChart(),
            'chartColor' => $widget->getChartColor(),
            'color' => $widget->getColor(),
            'icon' => $widget->getIcon(),
            'description' => $widget->getDescription(),
            'descriptionIcon' => $widget->getDescriptionIcon(),
            'descriptionIconPosition' => $widget->getDescriptionIconPosition(),
            'descriptionColor' => $widget->getDescriptionColor(),
            'shouldOpenUrlInNewTab' => $widget->shouldOpenUrlInNewTab(),
            'url' => $widget->getUrl(),
            'id' => $widget->getId(),
            'label' => $widget->getLabel(),
            'value' => $widget->getValue()
        ]);
    }

    public function getZonesCount()
    {

        $widget = ZonesCountWidget::getStat();

        return response()->json([
            'extraAttributes' => $widget->getExtraAttributes(),
            'chart' => $widget->getChart(),
            'chartColor' => $widget->getChartColor(),
            'color' => $widget->getColor(),
            'icon' => $widget->getIcon(),
            'description' => $widget->getDescription(),
            'descriptionIcon' => $widget->getDescriptionIcon(),
            'descriptionIconPosition' => $widget->getDescriptionIconPosition(),
            'descriptionColor' => $widget->getDescriptionColor(),
            'shouldOpenUrlInNewTab' => $widget->shouldOpenUrlInNewTab(),
            'url' => $widget->getUrl(),
            'id' => $widget->getId(),
            'label' => $widget->getLabel(),
            'value' => $widget->getValue()
        ]);
    }

}
