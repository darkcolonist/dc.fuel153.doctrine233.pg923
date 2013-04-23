<?php

namespace model;

/**
 * Users
 *
 * @Table(name="users")
 * @Entity
 */
class Users
{
    /**
     * @var bigint $id
     *
     * @Column(name="id", type="bigint", nullable=false)
     * @Id
     * @GeneratedValue(strategy="SEQUENCE")
     * @SequenceGenerator(sequenceName="users_id_seq", allocationSize="1", initialValue="1")
     */
    private $id;

    /**
     * @var text $firstName
     *
     * @Column(name="first_name", type="text", nullable=true)
     */
    private $firstName;

    /**
     * @var text $lastName
     *
     * @Column(name="last_name", type="text", nullable=true)
     */
    private $lastName;

    /**
     * Get id
     *
     * @return bigint $id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set firstName
     *
     * @param text $firstName
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }

    /**
     * Get firstName
     *
     * @return text $firstName
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set lastName
     *
     * @param text $lastName
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }

    /**
     * Get lastName
     *
     * @return text $lastName
     */
    public function getLastName()
    {
        return $this->lastName;
    }
}