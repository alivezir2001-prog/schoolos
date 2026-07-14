# ADR-013

## Title

Academic Year Is A First-Class Domain Entity

---

## Status

Accepted

---

## Date

2026-07-13

---

## Context

Educational activities always occur within an academic cycle.

Treating AcademicYear as simple metadata limits historical analysis and longitudinal educational understanding.

---

## Decision

AcademicYear is defined as a first-class domain entity.

Educational records belong to an academic year rather than existing independently of time.

---

## Rationale

Educational development must remain historically traceable.

AcademicYear provides temporal structure across the platform.

---

## Consequences

Future modules reference AcademicYear explicitly.

Historical comparisons become possible.

---

## Alternatives Considered

### Store academic year as plain text.

Rejected because it lacks domain meaning and referential integrity.

---

## Related Documents

- EDUCATIONAL_CONTEXT_MODEL.md

---

## Notes

Educational time is part of educational context.