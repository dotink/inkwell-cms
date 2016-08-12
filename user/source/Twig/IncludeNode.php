<?php namespace Inkwell\CMS\Twig
{
	use Twig_Node;
	use Twig_NodeOutputInterface;
	use Twig_Node_Expression;
	use Twig_Compiler;

	/**
	 *
	 */
	class IncludeNode extends Twig_Node implements Twig_NodeOutputInterface
	{
		public function __construct(Twig_Node_Expression $expr, Twig_Node_Expression $variables = null, $only = false, $ignoreMissing = false, $lineno, $tag = null)
		{
			parent::__construct(array('expr' => $expr, 'variables' => $variables), array('only' => (bool) $only, 'ignore_missing' => (bool) $ignoreMissing), $lineno, $tag);
		}

		public function compile(Twig_Compiler $compiler)
		{
			$compiler->addDebugInfo($this);

			if ($this->getAttribute('ignore_missing')) {
				$compiler
					->write("try {\n")
					->indent()
				;
			}

			$this->addGetTemplate($compiler);

			$compiler->raw('->display(');

			$this->addTemplateArguments($compiler);

			$compiler->raw(");\n");

			if ($this->getAttribute('ignore_missing')) {
				$compiler
					->outdent()
					->write("} catch (Twig_Error_Loader \$e) {\n")
					->indent()
					->write("// ignore missing template\n")
					->outdent()
					->write("}\n\n")
				;
			}
		}

		protected function addGetTemplate(Twig_Compiler $compiler)
		{
			$compiler
				 ->write('$this->loadTemplate("(partials) " .')
				 ->subcompile($this->getNode('expr'))
				 ->raw(', ')
				 ->repr($compiler->getFilename())
				 ->raw(', ')
				 ->repr($this->getLine())
				 ->raw(')')
			 ;
		}

		protected function addTemplateArguments(Twig_Compiler $compiler)
		{
			if (null === $this->getNode('variables')) {
				$compiler->raw(false === $this->getAttribute('only') ? '$context' : 'array()');
			} elseif (false === $this->getAttribute('only')) {
				$compiler
					->raw('array_merge($context, ')
					->subcompile($this->getNode('variables'))
					->raw(')')
				;
			} else {
				$compiler->subcompile($this->getNode('variables'));
			}
		}
	}
}
