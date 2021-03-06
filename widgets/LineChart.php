<?php
# * ********************************************************************* *
# *                                                                       *
# *   Yii2 Models and Modules                                             *
# *   This file is part of idbyii2. This project may be found at:         *
# *   https://github.com/IdentityBank/Php_idbyii2.                        *
# *                                                                       *
# *   Copyright (C) 2020 by Identity Bank. All Rights Reserved.           *
# *   https://www.identitybank.eu - You belong to you                     *
# *                                                                       *
# *   This program is free software: you can redistribute it and/or       *
# *   modify it under the terms of the GNU Affero General Public          *
# *   License as published by the Free Software Foundation, either        *
# *   version 3 of the License, or (at your option) any later version.    *
# *                                                                       *
# *   This program is distributed in the hope that it will be useful,     *
# *   but WITHOUT ANY WARRANTY; without even the implied warranty of      *
# *   MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the        *
# *   GNU Affero General Public License for more details.                 *
# *                                                                       *
# *   You should have received a copy of the GNU Affero General Public    *
# *   License along with this program. If not, see                        *
# *   https://www.gnu.org/licenses/.                                      *
# *                                                                       *
# * ********************************************************************* *

################################################################################
# Namespace                                                                    #
################################################################################

namespace idbyii2\widgets;

################################################################################
# Use(s)                                                                       #
################################################################################

use app\helpers\BusinessConfig;
use idbyii2\widgets\assets\LineChartAsset;
use yii\base\Widget;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

################################################################################
# Class(es)                                                                    #
################################################################################

/**
 * Class IconBox
 *
 * @package idbyii2\widgets
 */
class LineChart extends Widget
{
    public $options = [];
    public $data = [];

    /**
     * Init code widget view
     *
     * @throws \yii\base\InvalidConfigException
     */
    public function init()
    {
        $view = $this->getView();
        LineChartAsset::register($view);

        parent::init();

        if (!isset($this->options['id'])) {
            $this->options['id'] = $this->getId();
        }
    }

    /**
     * Base section to display our widget
     *
     * @return string|void
     */
    public function run()
    {
        $content = $this->renderMainSection();
        $content .= BusinessConfig::jsOptions(
            [
                'data' => json_encode($this->data),
                'id' => $this->options['id']
            ]
        );
        $options = $this->options;
        $tag = ArrayHelper::remove($options, 'tag', 'div');

        echo Html::tag($tag, $content, $options);
    }

    /**
     * @return string
     */
    public function renderMainSection()
    {
        return Html::tag('canvas', '', []);
    }
}

################################################################################
#                                End of file                                   #
################################################################################
