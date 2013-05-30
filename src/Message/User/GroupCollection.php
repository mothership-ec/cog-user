<?php

namespace Message\User;

/**
 * A container for all user groups available to the system.
 *
 * @author Joe Holdcroft <joe@message.co.uk>
 */
class GroupCollection implements \IteratorAggregate, \Countable
{
	protected $_groups = array();

	/**
	 * Constructor.
	 *
	 * @param array $groups An array of user groups to add
	 */
	public function __construct(array $groups = array())
	{
		foreach ($groups as $name => $group) {
			$this->add($group);
		}
	}

	/**
	 * Add a user group to this collection.
	 *
	 * @param GroupInterface $group The user group to add
	 *
	 * @return GroupCollection      Returns $this for chainability
	 *
	 * @throws \InvalidArgumentException If a group with the same name has
	 *                                   already been set on this collection
	 */
	public function add(GroupInterface $group)
	{
		if (isset($this->_groups[$group->getName()])) {
			throw new \InvalidArgumentException(sprintf('User group `%s` already defined.', $group->getName());
		}

		$this->_groups[$group->getName()] = $group;

		return $this;
	}

	/**
	 * Get the number of user groups registered on this collection.
	 *
	 * @return int The number of user groups registered
	 */
	public function count()
	{
		return count($this->_groups);
	}

	/**
	 * Get the iterator object to use for iterating over this class.
	 *
	 * @return \ArrayIterator An \ArrayIterator instance for the `_groups`
	 *                        property
	 */
	public function getIterator()
	{
		return new \ArrayIterator($this->_groups);
	}
}