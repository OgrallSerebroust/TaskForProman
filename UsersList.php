<?php

namespace TaskForProman;

class UsersList implements \Countable, \Iterator {
    public int $elementNumber;
    private int $countOfElements;

    function __construct(public $UsersList = array()) {
        $this->countOfElements = count($this->UsersList);
        $this->elementNumber = count($this->UsersList);
    }

    /**
     * @inheritDoc
     */
    public function count(): int {
        return $this->countOfElements;
    }

    /**
     * @inheritDoc
     */
    public function current(): mixed {
        return $this->UsersList[$this->elementNumber];
    }

    /**
     * @inheritDoc
     */
    public function next(): void {
        ++$this->elementNumber;
    }

    /**
     * @inheritDoc
     */
    public function key(): int {
        return $this->elementNumber;
    }

    /**
     * @inheritDoc
     */
    public function valid(): bool {
        return isset($this->UsersList[$this->elementNumber]);
    }

    /**
     * @inheritDoc
     */
    public function rewind(): void {
        $this->elementNumber = 0;
    }

    public function add(Users $user) {
        try {
            if ($this->countOfElements != 0) {
                $this->next();
                if ($this->search($user->id) == null) {
                    $this->UsersList[]=$user;
                    if ($this->valid()) $this->countOfElements++;
                }
                else throw new UserExistsException();
            }
            else {
                $this->UsersList[]=$user;
                if ($this->valid()) $this->countOfElements++;
            }
        } catch (UserExistsException $exception) {
            echo $exception->getMessage();
        }
    }

    public function search(int $id): mixed {
        $this->rewind();
        while ($this->elementNumber < $this->countOfElements) {
            if ($this->current()->id == $id) {
                $tempSearchedIdElementStorage = $this->current();
                $this->elementNumber = $this->countOfElements -1;
                return $tempSearchedIdElementStorage;
            }
            $this->elementNumber++;
        }
        if ($this->elementNumber == $this->countOfElements) return null;
    }
}