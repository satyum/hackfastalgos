<?HH
/**
 * Hack Fast Algos
 *
 * Implementation of a generic binary tree node
 */

namespace HackFastAlgos\DataStructure;

class TreeNode
{
	public ?T $value = null;
	public string $key;

	public ?TreeNode $parent = null;

	public ?TreeNode $leftChild = null;
	public ?TreeNode $middleChild = null;
	public ?TreeNode $rightChild = null;

	public function attachLeftChild(TreeNode $leftChild)
	{
		$this->leftChild = $leftChild;
		$leftChild->parent = $this;
	}

	public function attachMiddleChild(TreeNode $middleChild)
	{
		$this->middleChild = $middleChild;
		$middleChild->parent = $this;
	}

	public function attachRightChild(TreeNode $rightChild)
	{
		$this->rightChild = $rightChild;
		$rightChild->parent = $this;
	}

	public function attachAsLeftChildOf(TreeNode $parent)
	{
		$this->parent = $parent;
		$parent->leftChild = $this;
	}

	public function attachAsMiddleChildOf(TreeNode $parent)
	{
		$this->parent = $parent;
		$parent->middleChild = $this;
	}

	public function attachAsRightChildOf(TreeNode $parent)
	{
		$this->parent = $parent;
		$parent->rightChild = $this;
	}

	public function hasChild() : bool
	{
		return $this->leftChild !== null || $this->middleChild !== null || $this->rightChild !== null;
	}
}
