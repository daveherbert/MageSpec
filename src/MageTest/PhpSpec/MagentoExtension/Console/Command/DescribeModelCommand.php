<?php
/**
 * MageSpec
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the MIT License, that is bundled with this
 * package in the file LICENSE.
 * It is also available through the world-wide-web at this URL:
 *
 * http://opensource.org/licenses/MIT
 *
 * If you did not receive a copy of the license and are unable to obtain it
 * through the world-wide-web, please send an email
 * to <magetest@sessiondigital.com> so we can send you a copy immediately.
 *
 * @category   MageTest
 * @package    PhpSpec_MagentoExtension
 *
 * @copyright  Copyright (c) 2012-2013 MageTest team and contributors.
 */
namespace MageTest\PhpSpec\MagentoExtension\Console\Command;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

/**
 * DescribeModelCommand
 *
 * @category   MageTest
 * @package    PhpSpec_MagentoExtension
 *
 * @author     MageTest team (https://github.com/MageTest/MageSpec/contributors)
 */
class DescribeModelCommand extends MageCommand
{
    /**
     * @var string
     */
    protected $validator = '/^([a-zA-Z0-9]+)_([a-zA-Z0-9]+)\/([a-zA-Z0-9]+)(_[\w]+)?$/';

    /**
     * @var string
     */
    protected $help = <<<HELP
The model alias provided doesn't follow the Magento naming conventions.
Please make sure it looks like the following:

  vendorname_modulename/modelname

The lowercase convention is used because it reflects the best practice
convention within the Magento community. This reflects the identifier that
you would pass to Mage::getModel() or Mage::getSingleton().
HELP;

    /**
     * @var string
     */
    protected $type = 'model';

    protected function configure()
    {
        $this
            ->setName('describe:model')
            ->setDescription('Describe a Magento Model specification')
            ->setDefinition(
                array(
                    new InputOption(
                        'codepool',
                        null,
                        InputArgument::OPTIONAL,
                        'The Magento Codepool in which to create the class'
                    )
                )
            )
            ->addArgument('alias', InputArgument::REQUIRED, 'Magento Model alias to be described');
    }
}
