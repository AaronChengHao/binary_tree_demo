<?php
namespace Aaron;
class TreeException extends \RuntimeException{}
class Node
{
    private $value;
    private $leftNode;
    private $rightNode;

    public function __construct( int $num )
    {
        $this->setValue($num);
    }

    public function getValue()
    {
        return $this->value;
    }

    public function setValue( int $value )
    {
        $this->value = $value;
    }

    public function getLeftNode(): ?Node
    {
        return $this->leftNode;
    }

    public function getRightNode() : ?Node
    {
        return $this->rightNode;
    }

    public function setLeftNode( Node $node ) : Node
    {
        $this->leftNode = $node;
        return $this;
    }

    public function setRightNode( Node $node ) : Node
    {
        $this->rightNode = $node;
        return $this;
    }
}

class Tree
{
    private $rootNode;

    public function __construct()
    {
        $this->rootNode = new Node(0);
    }

    public function addNodeForNum( int $num )
    {
        $this->add(new Node($num));
    }

    public function add( Node $node )
    {
        $this->loopAdd($this->rootNode,$node);
    }

    public function find( int $num )
    {
        return $this->loopFind($this->rootNode, $num);
    }

    private function loopFind( Node $nextNode, $value )
    {
        if ( $nextNode->getValue() == $value ){
            return $nextNode;
        }

        if ( $value > $nextNode->getValue() ){
            if ( $rightNode = $nextNode->getRightNode() ){
                return $this->loopFind($rightNode,$value);
            }
        }else{
            if ( $leftNode = $nextNode->getLeftNode() ){
                return $this->loopFind($leftNode,$value);
            }
        }
        return null;
    }

    private function loopAdd( Node $nextNode, Node $addNode )
    {
        if ( $nextNode->getValue() == $addNode->getValue() ){
            throw new TreeException(sprintf('nextNode value Not equal to AddNode value.  nextNode->%s  addNode->%s',$nextNode->getValue(),$addNode->getValue()));
        }
        // 右节点
        if ( $addNode->getValue() > $nextNode->getValue() ){
            if ( $rightNode =  $nextNode->getRightNode() ){
                $this->loopAdd($rightNode,$addNode);
            }else{
                $nextNode->setRightNode($addNode);
            }
        } else {
        // 左节点
            if ( $leftNode = $nextNode->getLeftNode() ){
                $this->loopAdd($leftNode,$addNode);
            }else{
                $nextNode->setLeftNode($addNode);
            }
        }
    }
}
