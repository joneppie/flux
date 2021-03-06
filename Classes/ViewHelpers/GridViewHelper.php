<?php
namespace FluidTYPO3\Flux\ViewHelpers;

/*
 * This file is part of the FluidTYPO3/Flux project under GPLv2 or later.
 *
 * For the full copyright and license information, please read the
 * LICENSE.md file that was distributed with this source code.
 */

use TYPO3\CMS\Fluid\Core\Rendering\RenderingContextInterface;

/**
 * Grid container ViewHelper
 */
class GridViewHelper extends AbstractFormViewHelper {

	/**
	 * Initialize
	 * @return void
	 */
	public function initializeArguments() {
		$this->registerArgument('name', 'string', 'Optional name of this grid - defaults to "grid"', FALSE, 'grid');
		$this->registerArgument('label', 'string', 'Optional label for this grid - defaults to an LLL value (reported if it is missing)', FALSE, NULL);
		$this->registerArgument('variables', 'array', 'Freestyle variables which become assigned to the resulting Component - ' .
			'can then be read from that Component outside this Fluid template and in other templates using the Form object from this template', FALSE, array());
	}

	/**
	 * @param array $arguments
	 * @param \Closure $renderChildrenClosure
	 * @param RenderingContextInterface $renderingContext
	 * @return void
	 */
	static public function renderStatic(array $arguments, \Closure $renderChildrenClosure, RenderingContextInterface $renderingContext) {
		$grid = static::getGridFromRenderingContext($renderingContext, $arguments['name']);
		$grid->setExtensionName(static::getExtensionNameFromRenderingContextOrArguments($renderingContext, $arguments));
		$grid->setParent(static::getFormFromRenderingContext($renderingContext));
		$grid->setLabel($arguments['label']);
		$grid->setVariables($arguments['variables']);
		$container = static::getContainerFromRenderingContext($renderingContext);
		static::setContainerInRenderingContext($renderingContext, $grid);
		$renderChildrenClosure();
		static::setContainerInRenderingContext($renderingContext, $container);
	}

}
