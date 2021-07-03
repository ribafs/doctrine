<?php
/*
É por meio dessas annontations (@) que iremos ‘informar’ ao doctrine nossa entidade e suas especificações
*/

/**
 * @Entity @Table(name="customers")
 */
class Customer
{
    /** @Id @Column(type="integer") @GeneratedValue */
    protected $id;
    /** @Column(type="string", length=40) */
    protected $name;
    /** @Column(type="string", length=40) */
    protected $email;
    /** @Column(type="string",length=15) */
    protected $ssn;

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getSsn()
    {
        return $this->ssn;
    }

    public function setSsn($ssn)
    {
        $this->ssn = $ssn;
    }
}
