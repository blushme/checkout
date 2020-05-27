<?php
namespace BlushMe\Core\Observer\ControllerActionPredispatch;
use Magento\Framework\Event\Observer as O;
use Magento\Framework\Event\ObserverInterface;
// 2020-05-27
// "Customers should be redirected from the `/checkout/cart` page to the Klarna checkout page":
// https://github.com/blushme/core/issues/4
final class CheckoutCartIndex implements ObserverInterface {
	/**
	 * 2020-05-27
	 * @override
	 * @see ObserverInterface::execute()
	 * @used-by \Magento\Framework\Event\Invoker\InvokerDefault::_callObserverMethod()
	 * @see \Magento\Framework\App\Action\Action::dispatch()
	 * 		$eventParameters = ['controller_action' => $this, 'request' => $request];
	 *		$this->_eventManager->dispatch(
	 *			'controller_action_predispatch_' . $request->getFullActionName(),
	 *			$eventParameters
	 *		);
	 * https://github.com/magento/magento2/blob/2.3.5-p1/lib/internal/Magento/Framework/App/Action/Action.php#L96-L102
	 * @param O $o
	 */
	function execute(O $o) {df_redirect_to_checkout();}
}