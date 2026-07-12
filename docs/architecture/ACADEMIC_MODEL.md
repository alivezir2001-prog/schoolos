# Academic Model

> *"Educational understanding begins with a well-designed academic structure."*

| Field | Value |
|--------|-------|
| Status | Draft |
| Version | 1.0 |
| Owner | SchoolOS Team |
| Last Updated | 2026-07-13 |

---

# Purpose

The Academic Model defines the core educational entities and relationships used throughout SchoolOS.

It provides the structural foundation for scheduling, teaching assignments, observations, educational evidence, learner development and educational continuity.

Every educational workflow within SchoolOS depends on this model.

---

# Vision

Schools change.

Teachers change.

Classes change.

Academic years change.

The Academic Model ensures that educational relationships remain clear, consistent and historically traceable.

---

# Core Principles

## Academic Years Matter

Educational relationships always exist within an academic year.

Nothing should assume permanence across years.

---

## Teaching Is an Assignment

Teachers are not permanently attached to classes.

They are assigned to teach a specific lesson to a specific class during a specific academic year.

---

## Learners Belong to Classes

Learners are enrolled in school classes for an academic year.

Their educational journey, however, extends beyond any single class.

---

## Educational History Must Be Preserved

Changes in teachers, classes or schools should never erase historical educational relationships.

SchoolOS preserves educational continuity through historical records.

---

# Core Entities

The Academic Model consists of the following primary entities.

- School
- Academic Year
- School Class
- Teacher
- Student
- Lesson
- Teaching Assignment

---

# Entity Relationships

```text
School
    │
    ├──────────────┐
    ▼              ▼

Academic Year     Teacher
    │              │
    ▼              │
School Class       │
    ▲              │
    │              ▼
Teaching Assignment
    ▲       ▲      ▲
    │       │      │
 Lesson   Teacher  Academic Year

Student
    │
    ▼
School Class
```

---

# Teaching Assignment

The Teaching Assignment is the central relationship within the Academic Model.

Each assignment defines:

- Which teacher teaches
- Which lesson
- To which class
- During which academic year

Optional attributes may include:

- Weekly hours
- Homeroom teacher
- Active status

---

# Educational Impact

The Academic Model supports:

- Timetables
- Attendance
- Observations
- Assessments
- Homework
- Educational Evidence
- Development
- AI Teacher Brief
- Learner Profile
- Educational Passport

Every educational experience depends on this structure.

---

# Future Vision

The Academic Model is designed to support future capabilities including:

- Multiple campuses
- Co-teaching
- Substitute teachers
- Flexible learning groups
- Cross-class lessons
- Personalized learning pathways

The model should evolve without compromising educational continuity.

---

# SchoolOS Promise

Educational software should reflect how schools actually work.

The Academic Model exists to ensure that every educational relationship is represented accurately, consistently and sustainably.