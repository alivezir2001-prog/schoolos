# SchoolOS Development Standard

Version: 1.0

---

# Purpose

This document defines the software development standards of SchoolOS.

Its purpose is to ensure that every module follows the same architecture, coding style, development workflow, and educational philosophy.

---

# Vision

SchoolOS is not a traditional school management system.

It is a Development Operating System.

The purpose of SchoolOS is to support, preserve and improve the development of students, teachers, schools and educational organizations.

---

# Core Principles

## 1. Working Software First

Every sprint must produce a working feature.

Perfect software is built through continuous improvement.

---

## 2. Build Small

Develop one complete feature at a time.

Avoid unfinished modules.

---

## 3. Evidence Before Opinion

SchoolOS stores evidence.

Reports, analytics, evaluations and AI insights are always generated from evidence.

Opinions are never primary data.

---

## 4. Development Before Measurement

SchoolOS exists to support development.

Measurement is only a tool.

Development is the objective.

---

## 5. School-Centered Architecture

School is the primary organizational boundary.

Every school-owned entity contains:

- school_id

unless the entity is globally shared.

---

## 6. Security by Default

SYS_ADMIN may access every school.

School users may access only their own school.

Authorization is mandatory.

User interface restrictions are never considered security.

---

## 7. Explicit Code

Readable code is preferred over framework magic.

If the implementation becomes difficult to understand, simplify it.

---

## 8. Reuse Before Rewrite

Common logic should be extracted into reusable components.

Avoid duplication.

---

# Development Workflow

Every feature follows the same lifecycle.

Idea

↓

Model

↓

Migration

↓

CRUD

↓

Authorization

↓

Testing

↓

Documentation

↓

Commit

---

# Sprint Rules

Each sprint should:

- produce one complete feature
- be fully testable
- end with a clean Git commit

---

# Git Convention

Feature

feat(...)

Bug Fix

fix(...)

Documentation

docs(...)

Research

research(...)

Refactor

refactor(...)

---

# Definition of Done

A feature is complete only if:

✓ Working

✓ Tested

✓ Authorized

✓ Documented

✓ Committed

---

# SchoolOS Rule

Do not build software to manage schools.

Build software that helps schools continuously develop.

---

End of document.