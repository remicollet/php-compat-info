<?php declare(strict_types=1);

namespace Bartlett\CompatInfo\Sniffs\Operators;

use Bartlett\CompatInfo\Sniffs\SniffAbstract;

use PhpParser\Node;

/**
 * Combined Comparison (Spaceship) Operator since PHP 7.0.0 alpha1
 *
 * @link https://wiki.php.net/rfc/combined-comparison-operator
 *
 * @see tests/Sniffs/CombinedComparisonOperatorSniffTest
 * @since Class available since Release 5.4.0
 */
final class CombinedComparisonOperatorSniff extends SniffAbstract
{
    /**
     * {@inheritDoc}
     */
    public function enterNode(Node $node)
    {
        if (!$node instanceof Node\Expr\BinaryOp\Spaceship) {
            return null;
        }

        $this->updateNodeElementVersion($node, $this->attributeKeyStore, ['php.min' => '7.0.0alpha1']);
    }
}
